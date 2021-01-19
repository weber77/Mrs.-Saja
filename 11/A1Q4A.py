import random

P =random.random()
    

print('The random number generated is:',P)
if P > 0.500000:
    print('(Heads is True, Tails is False):',P>0.500000)
else:
    print('(Heads is False, Tails is True):',P>0.500000)
