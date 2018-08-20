import os
import sys
import mysql.connector
import re
import feedparser 
import codecs
import newspaper
import errno
from unidecode import unidecode
from newspaper import Article
from HTMLParser import HTMLParser
from urlparse import urlparse

# Check if database login arguments were provided
if len(sys.argv) < 5:
	print("No arguments provided. Please provide the database host, user, password and database.")
	sys.exit();
else:
	dbhost=sys.argv[1]
	dbuser=sys.argv[2]
	dbpass=sys.argv[3]
	dbbase=sys.argv[4]

# Initialize the connection
db = mysql.connector.connect(host=dbhost, user=dbuser, password=dbpass, database=dbbase)
c = db.cursor()

# Set up some useful constants
BASE_URL = "http://nfinit.systems/legacy/news/"
STORE_PATH = "/opt/bitnami/apache2/htdocs/nsr/store/legacy/news/"

# Initialize some status variables
sources_processed = 0
feeds_processed = 0
posts_processed = 0
posts_archived = 0

### FUNCTION DEFINITIONS ###

# Fix unicode quotes that don't display properly on older browsers
def fix_unicode(html):
	 return unidecode(html)

# Sets up a path in /nsr/store if it doesn't already exist
def store(path):
	path = STORE_PATH + path
        try:
                os.makedirs(path + "/articles/")
        except OSError as exc:
                if exc.errno == errno.EEXIST and os.path.isdir(path + "/articles/"):
                        pass
                else:
                        raise

# Generate a filename given a URL
def gen_filename(url):
	url = urlparse(url)
	filename = url.path
	filename = re.sub('(index)*\.[A-Za-z]+\?*', '', filename)
	filename = filename.rstrip('/').lstrip('/')
	filename = filename + '-' + url.query
	filename = filename.replace("/","-")
	filename = re.sub('[^a-zA-Z0-9-_]+', '', filename);
	filename = filename.rstrip('-').lstrip('-')
	if len(filename) > 250:
		filesplit = filename.split('-')
		endpoint = len(filesplit)/2
		filesplit = filesplit[0:endpoint]
		filename = '-'.join(filesplit)
	filename = filename + '.html'
	return filename

# Archives an article at the specified path with newspaper using its URL
def archive(url, path):
	global posts_archived
	link_url = BASE_URL + path + "/"
	path = STORE_PATH + path + "/articles/"
	if not os.path.isdir(path):
		return

	#Filter the article's URL and turn it into a filename and a url
	filename = gen_filename(url)

	#Check if the file already exists so we don't have to re-download it
	if os.path.isfile(path + filename):
		url = fix_unicode(url)
		return filename
	else:
		logurl = fix_unicode(url)

	#Create the file
	article = Article(url)
	article.download()
	article.parse()

	html = '<a name="top"></a>'
	html += '<div align="center"><h1>' + fix_unicode(article.title) + '</h1></div>' + "\n"
	body = article.text
	body = fix_unicode(body)
	body = body.replace('\n',"<br>")
	body = re.sub('(<br\s*\/?>\n*){3,}', '<br><br>', body, flags=re.S)
	html += body

	storefile = codecs.open(path + filename, "w", "utf-8")
	storefile.write(html)
	storefile.close()

	posts_archived += 1

	return filename
		
# Generate a list item for a given RSS post
def gen_post(post, path, describe, arc):
	global posts_processed
	h = HTMLParser()
	html = "<li>"
	if post.title:
		title = re.sub('<[^<]+?>', '', post.title)
		if arc and hasattr(post, 'link') and post.link:
			get = archive(post.link, path)
			url = BASE_URL + path + "/?article=" + get
			html += "<a href=\"" + url + "\">"
		html += "<strong>" + fix_unicode(h.unescape(title)) + "</strong>"
		if arc and hasattr(post, 'link') and post.link: html += "</a>"
		if hasattr(post, 'link') and post.link: html += ' ' + '<a href="' + post.link + '">(view source)</a>'
		html += "\n"
	if describe and hasattr(post, 'description'):
		description = re.sub(r'<div.*>.*<\/div>', '', post.description, flags=re.S)
		description = re.sub(r'<img.*?>', '', description, flags=re.S)
		description = re.sub('<[^<]+?>', '', description)
		description = h.unescape(description)
		description = fix_unicode(description)
		if description and post.title: html += "<br>"
		if description: html += '<p>' + description + '</p>'
	html += "</li>\n"
	posts_processed += 1
	if not post.title and not description: return ''
	return html 

# Generate a feed category index
def gen_category(cat):
	global feeds_processed
	source = cat[0]
	title = cat[3]
	url = cat[4]
	path = cat[5]
	desc = int(cat[7])
	arc = int(cat[8])
	short = path.split("/")
	short = short[-1]

	print "Generating index: " + source + "/" + title,
	if arc: print "(archived)",
	print ""

	store(path)
	newsfile = codecs.open(STORE_PATH + path + "/index.html", "w", "utf-8")
	feed = feedparser.parse(url)

	html = "<div align=\"center\">\n"
	html += "<table width=\"550px\"><tr><td>\n"
	html += "<div align=\"center\">\n"
	html += "<a name=\"" + short + "\"></a>"
	# html +=  "<h2>" + '<a href="#' + short + '">' + title + "</a>"
	html +=  "<h2>" + title
	if arc: html += " (archived)"
	html += "</h2>"
	html += "</div>"
	html += "<ol>\n"
	for post in feed.entries:
		html += gen_post(post, path, desc, arc)
	html += "</ol>\n"
	html += "</td></tr></table>\n"
	html += '<a href="#home"><i>(back to top)</i></a>'
	html += "\n</div>\n"

	newsfile.write(html)
	newsfile.close()

	feeds_processed += 1

	return html

def gen_jumps(categories):
	if len(categories) < 2: return
	html = '<div align="center">'
	html += "<i>Jump to "
	for c, category in enumerate(categories):
		if c: html += ", "
		title = category[3]
		path = category[2]
		anchor = category[5]
		anchor = anchor.split("/")
		anchor = anchor[-1]
		html += '<a href="#' + anchor + '">'
		html += title
		html += "</a>"
	html += "</i>"
	html += "</div>"
	store(path)
	newsfile = codecs.open(STORE_PATH + path + "/index.html", "w", "utf-8")
	newsfile.write(html)
	newsfile.close()
	return html

def gen_feed(source):
	global sources_processed	
	c.execute("SELECT * FROM newsfeeds WHERE arg=%s ORDER BY siteorder ASC",source)
	categories = c.fetchall()
	gen_jumps(categories)
	for category in categories:
		gen_category(category)
	sources_processed += 1

def gen_feeds():
	c.execute("SELECT DISTINCT(arg) FROM newsfeeds")
	sources = c.fetchall()
	for source in sources:
		gen_feed(source)

### MAIN PROGRAM ###
gen_feeds()
print("********************************************************************************")
print("Complete. Processed " + str(posts_processed) + " posts (" + str(posts_archived) + " archived) from " + str(feeds_processed) + " feeds and " + str(sources_processed) + " sources.") 
