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

def makeStudentMarksList(studentList):
    newList = []
    newInnerList = []
  

    #create a new list with second half of studentList inner list and appends it to newList
    for i in range(len(studentList)):
        for j in range(int(len(studentList[i])/2), len(studentList[i])):
            
            newInnerList.append(studentList[i][j].strip())
        newList.append(newInnerList)
        newInnerList = []
     
    return newList

def getMinMax(list):

    min  = list[0]
    max = list[0]
    sum = 0

    for i in list:
        if min > i:
            min = i
        if max < i:
            max = i

        sum = sum + i


    avg = round( float(sum/len(list)), 2)

    min_max_avg =[]
    min_max_avg.append(min)
    min_max_avg.append(max)
    min_max_avg.append(avg)
    return min_max_avg

def calculateFinalMark():
    
    newList = makeStudentMarksList(studentList)

    assessment1 = []
    assessment2 = []
    assessment3 = []
    assessmentList = []

    for i in newList:
        assessment1.append(float(i[0]))
        assessment2.append(float(i[1]))
        assessment3.append(float(i[2]))

    min_max1 = getMinMax(assessment1)
    min_max2 = getMinMax(assessment2)
    final = getMinMax(assessment3)

    print("Assignment 1 " + str(min_max1[0]) + " " + str(min_max1[1]) + " " + str(min_max1[2]))
    print("Assignment 2 " + str(min_max2[0]) + " " + str(min_max2[1]) + " " + str(min_max2[2]))
    print("Final " + str(final[0]) + " " + str(final[1]) + " " + str(final[2]))


    #averages
    
    

   




def printResults():
   
    final_marks = calculateFinalMark()

    
if __name__ == "__main__":
    
    read_file()
    cleanStudentList(studentList)
    
    printResults()
    