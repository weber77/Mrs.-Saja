
import random

n = input("What kind of bias do your coins have ? ")
phead = input("What is the possibility that you want to give to  heads ( 0 to 1) : ")

n = int(n)

head_count = 0
tail_count = 0

phead = float(phead)

for S in range(n):
    if random.random() <= phead:
        print("The coin comes up heads")
        head_count += 1
    else:
        print("The coin comes up tails")
        tail_count += 1

print("Number of Heads Total: " , head_count)
print("Number of Tails Total: " , tail_count)
print("Number of Complete Heads: " ,(head_count/n))
print("Ration of heads: " ,(head_count/n))
