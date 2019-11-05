import requests
from bs4 import BeautifulSoup
import sys
pageno = 5499992
pageup = True
alladdress = []
csvfile = open('bitcoinaddress.csv','w')
while pageup==True:
    print('pageNo - '+str(pageno))
    url = 'https://bitcoinchain.com/block_explorer/catalog/' + str(pageno)
    page = requests.get(url)
    soup = BeautifulSoup(page.content, 'html.parser')
    rowdata = soup.find_all('tr')
    for row in rowdata:
        if len(row.find_all('a')) > 0:
            address = row.find_all('a')[0].get_text()
            if address in alladdress:
                pageup = False
                break
            else:
                csvfile.write(address)
                csvfile.write("\n")
                alladdress.append(address)
    if pageup:
        pageno += 1; 
csvfile.close()
print(str(len(alladdress))+' addresses added to csv file')
