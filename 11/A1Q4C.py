
import random

n = input("How times would you like to flip the coin? ")

n = int(n)

head_count = 0
tail_count = 0

phead = 0.5
ptail = 1 - phead

for S in range(n):
    if random.random() <= phead:
        print("The coin comes up heads")
        head_count += 1 #head and tail counter  not needed
    else:
        print("The coin comes up tails")
        tail_count += 1

