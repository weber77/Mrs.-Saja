import random

def print_random(n):
    for i in range(1,n+1):
        print("number %d: %d" %(i,random.randint(0,9)))

def adjust():

    print("Enter a whole number between 0 - 9: ")
    cent = int(input())
    if len(str(cent)) != 1: #convert cent to string using str() and get the length of cent using len(). For any integer in range 0 - 9 the length is 1
        raise Exception("Sorry number not in range 0 - 9")

    if cent <= 2:
        cent = 0
    elif cent > 2 and cent <=7:
        cent = 5
    else:
        cent = 10

    return cent


print(adjust())