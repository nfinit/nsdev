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
	print ("Setting up store path \"" + path + "\"...")
	path = STORE_PATH + path
        try:
                os.makedirs(path + "/articles/")
        except OSError as exc:
                if exc.errno == errno.EEXIST and os.path.isdir(path + "/articles/"):
                        pass
                else:
                        raise

# Archives an article at the specified path with newspaper using its URL
def archive(url, source_url, path):
	global posts_archived
	link_url = BASE_URL + path + "/"
	path = STORE_PATH + path + "/articles/"
	if not os.path.isdir(path):
		return

	#Filter the article's URL and turn it into a filename and a url
	source_url = source_url.split('://', 1)[-1]
	source_nosub = source_url.split('.')[1] + "." + source_url.split('.')[2]
	filename = url.split('/?', 1)[0]
	filename = filename.split('://', 1)[-1]
	filename = filename.split(source_nosub)[-1]
	filename = filename.split('?', 1)[0]
	filename = filename.replace("/index.html", "")
	filename = filename.replace("/","-")
	filename = re.sub('[^a-zA-Z0-9-_]+', '', filename);
	filename = filename.rstrip('-')
	filename = filename.lstrip('-')
	filename = filename + ".html"

	#Check if the file already exists so we don't have to re-download it
	if os.path.isfile(path + filename):
		print("Post at " + url + " has already been archived.")
		return filename
	else:
		print("Archiving post at " + url + "...")

	#Create the file
	article = Article(url)
	article.download()
	article.parse()

	html = '<div align="center"><h1>' + fix_unicode(article.title) + '</h1></div>' + "\n"
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
def gen_post(post, source_url, path, describe, arc):
	global posts_processed
	h = HTMLParser()
	html = "<li>"
	if post.title:
		title = re.sub('<[^<]+?>', '', post.title)
		if arc and hasattr(post, 'link') and post.link:
			get = archive(post.link, source_url, path)
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
	surl = cat[1]
	title = cat[4]
	url = cat[5]
	path = cat[6]
	desc = int(cat[8])
	arc = int(cat[9])

	print "Generating index: " + source + "/" + title,
	if arc: print "(archived)",
	print ""

	store(path)
	newsfile = codecs.open(STORE_PATH + path + "/index.html", "w", "utf-8")
	feed = feedparser.parse(url)

	html = "<div align=\"center\">\n"
	html +=  "<h2>" + title
	if arc: html += " (locally archived)"
	html += "</h2>"
	html += "<table width=\"550px\"><tr><td>\n"
	html += "<ol>\n"
	for post in feed.entries:
		html += gen_post(post, surl, path, desc, arc)
	html += "</ol>\n"
	html += "</td></tr></table>\n"
	html += "</div>\n"

	newsfile.write(html)
	newsfile.close()

	feeds_processed += 1

	return html

def gen_feed(source):
	global sources_processed	
	c.execute("SELECT * FROM newsfeeds WHERE arg=%s ORDER BY siteorder ASC",source)
	categories = c.fetchall()
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
