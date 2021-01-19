import math

def root(X,n):
    S = 10**(math.log10(X)/n)
    return S

def main():
    X = int(input("Please, Enter a Number = "))
    n = int(input("Please, Enter The value For n = "))
    print("The {}th root of {} is {}".format(n,X,root(X,n)))


main()
