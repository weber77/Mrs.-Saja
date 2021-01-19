from random import random


def flip(Bias):

    return random() < Bias

def main():
    Bias = float(input("What kind of bias do your coins have? "))
    count = {False: 0, True: 0}
    for i in range(1, 4):
        T = flip(Bias)
        count[T] += 1
        print("Coin flip {} has a value of heads: {}".format(i, T ))



main()
