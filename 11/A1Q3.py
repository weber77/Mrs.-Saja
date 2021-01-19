def Name(string, vowels): 
    Final = [each for each in string if each in vowels] 
    print(len(Final)) 
    print(Final) 
      




#Program runs correct but doesn't meet q3 expectations
#this program takes 
# input: name from user
#  output : name length and number of occurance of each vowel 

def NameProcess(vowels): 
    print("Enter username: ", end="")
    name = input() # get username
    name = name.lower() #convert name to lowercase
    
    Final = [each for each in name if each in vowels] 
    name_length = len(name) #get name length
    
    vowel_list = list(vowels)
    print(vowel_list)
    vowel_number = []

    for i in range(5):
        vowel_number.append(0)

    for i in Final:
        if i == 'a':
            vowel_number[0] += 1
        elif i == "e":
            vowel_number[1] += 1
        elif i == "i":
            vowel_number[2] += 1
        elif i == "o":
            vowel_number[3] += 1
        elif i == "u":
            vowel_number[4] += 1

    print( "The length of " + name + " is: " + str(name_length))
    print( "The occurance of vowels is as follows")
    for i in range(len(vowel_list)):
        print( vowel_list[i]+ ": " + str(vowel_number[i]) )


    
string = "Saja Aldawsari"
vowels = "aeiou"
NameProcess(vowels)