import sys
import newspaper
from newspaper import Article

if len(sys.argv) < 2:
	print("Not enough arguments. Please provide a valid BBC News article URL.")
	sys.exit()	

url = sys.argv[1]

article = Article(url)
article.download()
article.parse()


print("<h1 align=\"center\">" + article.title + "</h1>")
body = article.text
body = body.replace('\n','<br>')
body = body.replace('Media playback is unsupported on your device','')
body = body.replace('Media caption','')
print(body)
