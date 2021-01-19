import random

n = input("Please input the number of coin flips: ")

n = int(n)

first_side = 0
second_side = 0
third_side = 0

for i in range(n):
    x = random.randrange(start=0,stop=3)
    if x == 0:
        print(" Heads")
        first_side += 1
    elif x == 1:
        print(" Tails")
        second_side += 1
    else:
        print(" Third side")
        third_side += 1
        
print("First side :", first_side ,"Second side:", second_side ,"Third side:", third_side)
print("The ratio heads / total tries is:  " ,(first_side/second_side/n))
