package main

import (
	"fmt"
)

func swapNumbers(numbers []int) []int {
    numbers[0] = numbers[0] + numbers[1]
    numbers[1] = numbers[0] - numbers[1]
    numbers[0] = numbers[0] - numbers[1]
    return numbers
}

func main() {
	fmt.Println(swapNumbers([]int{0,2147483647}))
}
