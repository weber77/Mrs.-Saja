subjectCode = {}
subjectTitle = {}
fieldCount = {}
F = []
studentCount = {}
studentList = []

def read_file():
    count = 0
    with open("subject.txt") as f:
        for line in f:
            if count == 0:
                (key, val) = line.split("|")
                subjectCode[key] = val.rstrip()
                count += 1
            elif count == 1:
                (key, val) = line.split("|")
                subjectTitle[key] = val.rstrip()
                count += 1
            
            elif count == 2:
                (key, val) = line.split("|")
                fieldCount[key] = val.rstrip()
                count += 1
            elif count == 3:
                F.append(line.split("|"))
                count += 1
            elif count == 4:
                (key, val) = line.split("|")
                studentCount[key] = val.rstrip()
                count += 1
            else:
                studentList.append(line.split("|"))
                
                
def cleanStudentList(studentList):
    for i in range(len(studentList)):
        studentList[i] = studentList[i][1:]# remove leading 'S' from inner list
        studentList[i] = studentList[i][:(len(studentList[i]) -1)] # remove ending '\n' from inner list

        #loops through inner list and removes all spaces
        for j in range(len(studentList[i])):
            studentList[i][j] = studentList[i][j].rstrip()
        


    """ for i in studentList:
        print(i) """
def cleanF(F):
    for i in range(len(F)):
        #loops through inner list and removes all spaces
        for j in range(len(F[i])):
            F[i][j] = F[i][j].rstrip()

    return F[0][1:]
        

def makeStudentNameList(studentList):
    newList = []
    newInnerList = []
  
    #create new list with only half of the content of studentList inner list
    for i in studentList:

        newList.append(i[1])

    #print(newList)

    return newList

def makeStudentMarksList(studentList):
    newList = []
    newInnerList = []
  

    #create a new list with second half of studentList inner list and appends it to newList
    for i in range(len(studentList)):
        for j in range(int(len(studentList[i])/2), len(studentList[i])):
            
            newInnerList.append(studentList[i][j].strip())
        newList.append(newInnerList)
        newInnerList = []
     
    #print(newList)
    return newList


def calculateFinalMark():
    
    marks = makeStudentMarksList(studentList)
    coef = cleanF(F)

    coef1 = float(int(coef[0]) / 100)
    coef2 = float(int(coef[1]) / 100)
    coef3 = float(int(coef[2]) / 100)
    final_marks = []

    #create a list of mark by multiplying marks and coefficients and suming them
    for mark in marks:
        final_marks.append( round( ((float(mark[0]) * coef1 ) + (float(mark[1])  * coef2) + (float(mark[2] ) * coef3)), 2 ) )
                
    #print(final_marks)

    return final_marks

def printResults():
    names = makeStudentNameList(studentList)
    final_marks = calculateFinalMark()

    print( "Name" + "\t\t" + "Final mark")

    for i in range(len(final_marks)):
        print( '{0:14}  {1}'.format(str(names[i]), str(final_marks[i])))
        #print( str(names[i]) + "\t\t" + str(final_marks[i]))

if __name__ == "__main__":
    
    read_file()
    cleanStudentList(studentList)
    
    printResults()
    