package main

import(
	"fmt"
)

func main() {
	fmt.Println(longestCommonSubsequence("abcde", "ace"))
}

func max(arr []int) int {
	maxVal := 0
	for _, val := range arr {
		if val > maxVal {
			maxVal = val
		}
	}
	return maxVal
}

func longestCommonSubsequence(text1 string, text2 string) int {
	text1Len := len(text1)
	text2Len := len(text2)
	sLens := [][]int{}
	for i := 0; i < text1Len; i++ {
		lenArr := []int{}
		sLens = append(sLens, lenArr)
		for j := 0; j < text2Len; j++ {
			currentLen := 0
			if text1[i] == text2[j] {
				currentLen++
				if i > 0 && j > 0 {
					currentLen = currentLen + sLens[i - 1][j - 1] 
				}
			} else {
				if i > 0 || j > 0 {
					lastLenArr := []int{}
					if i > 0 && j > 0 {
						lastLenArr = append(lastLenArr, sLens[i - 1][j - 1])
					}
					if i > 0 {
						lastLenArr = append(lastLenArr, sLens[i - 1][j])
					}
					if j > 0 {
						lastLenArr = append(lastLenArr, sLens[i][j - 1])
					}
					currentLen = currentLen + max(lastLenArr)
				}
			}
			lenArr = append(lenArr, currentLen)
			sLens[i] = lenArr
		}
	}
	flattenSLens := []int{}
	for _, intArr := range sLens {
		for _, length := range intArr {
			flattenSLens = append(flattenSLens, length)
		}
	}
	return max(flattenSLens)
}
