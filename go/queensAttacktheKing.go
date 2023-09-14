package main

import "math"

func canAttack(queen, king []int, queens [8][8]int, start bool, direction int) bool {
    if queen[0] == king[0] && queen[1] == king[1] {
        return true
    }

    if queen[0] < 0 {
        return false
    }
    if queen[0] > 7 {
        return false
    }
    if queen[1] < 0 {
        return false
    }
    if queen[1] > 7 {
        return false
    }

    if !start && queens[queen[0]][queen[1]] == 1 {
        return false
    }

    if queen[0] == king[0] {
        if direction == -1 || direction == 1 {
            if canAttack([]int{queen[0], queen[1] + 1}, king, queens, false, 1) {
                return true
            }
        }
        if direction == -1 || direction == 2 {
            if canAttack([]int{queen[0], queen[1] - 1}, king, queens, false, 2) {
                return true
            }
        }
    }
    if queen[1] == king[1] {
        if direction == -1 || direction == 3 {
            if canAttack([]int{queen[0] + 1, queen[1]}, king, queens, false, 3) {
                return true
            }
        }
        if direction == -1 || direction == 4 {
            if canAttack([]int{queen[0] - 1, queen[1]}, king, queens, false, 4) {
                return true
            }
        }
    }

    if math.Abs(float64(queen[0] - king[0])) == math.Abs(float64(queen[1] - king[1])) {
        if direction == -1 || direction == 5 {
            if canAttack([]int{queen[0] + 1, queen[1] + 1}, king, queens, false, 5) {
                return true
            }
        }
        if direction == -1 || direction == 6 {
            if canAttack([]int{queen[0] - 1, queen[1] - 1}, king, queens, false, 6) {
                return true
            }
        }
        if direction == -1 || direction == 7 {
            if canAttack([]int{queen[0] + 1, queen[1] - 1}, king, queens, false, 7) {
                return true
            }
        }
        if direction == -1 || direction == 8 {
            if canAttack([]int{queen[0] - 1, queen[1] + 1}, king, queens, false, 8) {
                return true
            }
        }
    }

    return false
}

func queensAttacktheKing(queens [][]int, king []int) [][]int {
    status := [8][8]int{}

    for _, queen := range queens {
        status[queen[0]][queen[1]] = 1
    }

    result := [][]int{}

    for _, queen := range queens {
        if canAttack(queen, king, status, true, -1) {
            result = append(result, queen)
        }
    }

    return result
}

func main() {
  println(queensAttacktheKing([][]int{{1, 6}}, []int{3, 4}))
}
