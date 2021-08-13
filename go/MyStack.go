package main

import (
	"fmt"
)

func main() {
	myStack := Constructor()
	myStack.Push(1)
	myStack.Push(2)
	fmt.Println(myStack.Top())
	fmt.Println(myStack.Pop())
	fmt.Println(myStack.Empty())
}

type MyStack struct {
    list []int
}


/** Initialize your data structure here. */
func Constructor() MyStack {
    return MyStack{
        list: []int{},
    }
}


/** Push element x onto stack. */
func (this *MyStack) Push(x int)  {
    this.list = append(this.list, x)
}


/** Removes the element on top of the stack and returns that element. */
func (this *MyStack) Pop() int {
    item := this.list[len(this.list) - 1]
    this.list = this.list[:len(this.list) - 1]
    return item
}


/** Get the top element. */
func (this *MyStack) Top() int {
    return this.list[len(this.list) - 1]
}


/** Returns whether the stack is empty. */
func (this *MyStack) Empty() bool {
    return len(this.list) == 0
}
