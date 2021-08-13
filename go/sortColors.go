package main

import (
	"fmt"
)

func main() {
	nums := []int{2, 0, 2, 1, 1, 0}
	sortColors(nums)
	fmt.Println(nums)
}

func sortColors(nums []int)  {
    partition(nums, 0, len(nums) - 1)
}

func partition(nums []int, start int, end int) {
    var i, j int
    for i, j = start, start; j < end; j++ {
        if nums[j] < nums[end] {
            tmp := nums[j]
            nums[j] = nums[i]
            nums[i] = tmp
            i++
        }
    }

    tmp := nums[i]
    nums[i] = nums[end]
    nums[end] = tmp

    if start < i - 1 {
        partition(nums, start, i - 1)
    }
    if i + 1 < end {
        partition(nums, i + 1, end)
    }
}
