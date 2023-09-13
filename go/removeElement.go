package main

func removeElement(nums []int, val int) int {
    i := 0
    for _, num := range nums {
        if num != val {
            nums[i] = num
            i++
        }
    }
    return i
}

func main() {
  arr := []int{3, 2, 2, 3}
  removeElement(arr, 3)
  println(arr)
}
