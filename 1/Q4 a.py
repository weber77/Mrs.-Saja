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

def convertStudentListToTuple(studentList):
    newList = []
    newInnerList = []

    #create new list with only half of the content of studentList inner list
    for i in range(len(studentList)):
        for j in range(int(len(studentList[i])/2)):
            
            newInnerList.append(studentList[i][j])
        newList.append(newInnerList)
        newInnerList = []

    #create a new list with second half of studentList inner list and appends it to newList
    for i in range(len(studentList)):
        for j in range(int(len(studentList[i])/2), len(studentList[i])):
            
            newInnerList.append(studentList[i][j].strip())
        newList[i].append(newInnerList)
        newInnerList = []
                
                
    """ for i in newList:
        print(tuple(i))     """  
    
    return tuple(newList) #convert newList to tuple and return it

if __name__ == "__main__":
    
    read_file()
    cleanStudentList(studentList)
    tupleStudent = convertStudentListToTuple(studentList)
    for i in tupleStudent:
        print(tuple(i))  
