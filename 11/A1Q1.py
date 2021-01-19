x = int(input("Enter the number of X = " ))
y = int(input("Enter the number of Y = " ))

print("X * Y = ", x*y)



def sum(x, y):
    sum = 0
    while y > 0 :
        sum = sum + x
        y= y-1
    return sum

print(sum(x, y))


