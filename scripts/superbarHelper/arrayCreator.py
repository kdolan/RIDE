"""
    
    Author: Kevin J Dolan
    Project: RIDE
    File Name: arrayCreator.py
    Purpose: Write to output file with array for superbar. Requires two files: inputMembers.txt which has a list of
	members from edb and output.text. 
    Date: 12/28/12
    
"""

f = open("output.txt","w")

f.write('<script type="text/javascript">\nselected = new Array()\nnames = new Array()\n')
for line in open("inputMembers.txt"):
        goodString = line.rstrip()
        f.write('names.push("'+goodString+'")\n')
f.write('</script>')
f.close()
