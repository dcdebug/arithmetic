#include <stdio.h>

typedef struct Node{
        int data;
        struct Node *pervious;
        struct Node *next;

}Node,*pNode;


pNode createDoubleLinklist(void);

void printDoubleLinklist(pNode pHead);