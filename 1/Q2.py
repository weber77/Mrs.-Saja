

def genList(maxPower):
    
    li = []
    for i in range(maxPower):
        li.append(2**i)

    li.reverse()
    return li

def printList(powerList):
    current_beginning = len(powerList) - 1

    for i in range(len(powerList)):
        for j in range(current_beginning, len(powerList)):
            print( str(powerList[j]) + " ", end="")
            
        current_beginning -= 1
        print()

if __name__ == "__main__":
    print("How many row do you want to have printed")
    numberRows = int(input())

    powerList = genList(numberRows)
    printList(powerList)