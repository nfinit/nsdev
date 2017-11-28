import os
import sys
import mysql.connector as dbc
import re
import feedparser 
import codecs
import newspaper
from HTMLParser import HTMLParser

os.chdir("/opt/bitnami/apache2/htdocs")

if len(sys.argv) < 4:
	print("<p>Feed unavailable.</p>")
	sys.exit()

dbhost=sys.argv[1]
dbuser=sys.argv[2]
dbpass=sys.argv[3]

db = dbc.connect(host=dbhost, user=dbuser, password=dbpass, database='nfinit_systems')
cursor = db.cursor()

cursor.execute("SELECT DISTINCT(arg) FROM newsfeeds")
args = cursor.fetchall()
for arg in args:
	cursor.execute("SELECT * FROM newsfeeds WHERE arg=%s ORDER BY siteorder ASC",arg)
	records = cursor.fetchall()
	for record in records:
		title = record[3]
		url = record[4]
		path = "nsr/store/legacy/news/" + record[5]
		desc = int(record[7]) 
		h = HTMLParser()
		feed = feedparser.parse(url)
		if not os.path.exists(os.path.dirname(path + "/index.html")):
    			try:
        			os.makedirs(os.path.dirname(path + "/index.html"))
    			except OSError as exc: # Guard against race condition
        			if exc.errno != errno.EEXIST:
            				raise
		listfile = codecs.open(path + "/index.html", "w", "utf-8");
		html = ""
		html += "<h2 align=\"center\">" + title + "</h2>" + "\n"
		html += "<div align=\"center\">" + "\n"
		html += "<table width=\"500px\"><tr><td>"
		html += "<ol>" + "\n"
		for post in feed.entries:
			if not post.title: continue
			html += "<li>" + "<a href=\"" + post.link + "\"><strong>" + h.unescape(post.title) + "</strong></a>" + "\n"
			if desc > 0:
				description = post.description
				description = re.sub(r'<div.*>.*<\/div>', '', post.description, flags=re.S)
				description = re.sub(r'<img.*?>', '', description, flags=re.S)
				description = h.unescape(description)
				html += "<br>" + description + "</li>" + "\n"
		html += "</ol>" + "\n"
		html += "</td></tr></table>"
		html += "</div>"
		html += "<hr width=\"500px\">" + "\n"
		listfile.write(html)
		listfile.close()
