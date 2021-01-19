import random

def print_random(n):
    for i in range(1,n+1):
        print("number %d: %d" %(i,random.randint(0,9)))

def adjust():

    print("Enter a two decimal place floating number : ")
    cent = input()
    centString = list(str(cent))
    lastindex = len(centString)


    if int(centString[lastindex -1]) ==1 or int(centString[lastindex -1]) == 2:
        centSring[lastindex] = "0"
    elif int(centString[lastindex -1]) > 2 and int(centString[lastindex -1]) < 8:

        centString[lastindex -1] = "5"
    else:
        lastButOneIndex = int(centString[lastindex - 2])

        lastButOneIndex += 1
        centString[lastindex - 2] = str(lastButOneIndex)
        centString[lastindex - 1] = "0"

    newCent = ""
    for i in centString:
        newCent += i
    return float(newCent)

print(adjust())