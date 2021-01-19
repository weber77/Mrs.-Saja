d = {}

def readIntoDict():
    with open("abbreviations.txt") as f:
        for line in f:
            (key, val) = line.split(":")
            d[key] = val.rstrip() #rstrip() remove newline character
    return d

def convertMessageToList(msg):
    listedMessage = list(msg.split(" "))

    return listedMessage

def decodeMessage(msg):

    messageList = convertMessageToList(msg)
    decodedMessage = ""
    

    for word in messageList:
        matchFound = False

        for key, value in d.items() :
            if word == key:
                decodedMessage = decodedMessage + " " + value
                matchFound = True
                break
        if matchFound == False:
            decodedMessage = decodedMessage + " " + word
            

    print ("Translated message: " + decodedMessage)


if __name__ == '__main__':
    readIntoDict()

    print("Enter a abbreviation to translate: " , end = '')
    msg = str(input())
    decodeMessage(msg)
    