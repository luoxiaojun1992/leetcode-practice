package main

func checkPoint(grid [][]int, point []int, step int) bool {
    rowLen := len(grid)
    colLen := len(grid[0])

    if grid[point[0]][point[1]] == step {
        if step + 1 == rowLen * colLen {
            return true
        }

        if point[0] + 1 >= 0 && point[0] + 1 < rowLen && point[1] + 2 >= 0 && point[1] + 2 < colLen {
            if checkPoint(grid, []int{point[0] + 1, point[1] + 2}, step + 1) {
                return true
            }
        }

        if point[0] + 1 >= 0 && point[0] + 1 < rowLen && point[1] - 2 >= 0 && point[1] - 2 < colLen {
            if checkPoint(grid, []int{point[0] + 1, point[1] - 2}, step + 1) {
                return true
            }
        }

        if point[0] - 1 >= 0 && point[0] - 1 < rowLen && point[1] + 2 >= 0 && point[1] + 2 < colLen {
            if checkPoint(grid, []int{point[0] - 1, point[1] + 2}, step + 1) {
                return true
            }
        }

        if point[0] - 1 >= 0 && point[0] - 1 < rowLen && point[1] - 2 >= 0 && point[1] - 2 < colLen {
            if checkPoint(grid, []int{point[0] - 1, point[1] - 2}, step + 1) {
                return true
            }
        }

        if point[0] + 2 >= 0 && point[0] + 2 < rowLen && point[1] + 1 >= 0 && point[1] + 1 < colLen {
            if checkPoint(grid, []int{point[0] + 2, point[1] + 1}, step + 1) {
                return true
            }
        }

        if point[0] + 2 >= 0 && point[0] + 2 < rowLen && point[1] - 1 >= 0 && point[1] - 1 < colLen {
            if checkPoint(grid, []int{point[0] + 2, point[1] - 1}, step + 1) {
                return true
            }
        }

        if point[0] - 2 >= 0 && point[0] - 2 < rowLen && point[1] + 1 >= 0 && point[1] + 1 < colLen {        
            if checkPoint(grid, []int{point[0] - 2, point[1] + 1}, step + 1) {
                return true
            }
        }

        if point[0] -2 >= 0 && point[0] - 2 < rowLen && point[1] - 1 >= 0 && point[1] - 1 < colLen {  
            if checkPoint(grid, []int{point[0] - 2, point[1] - 1}, step + 1) {
                return true
            }
        }
    }

    return false
}

func checkValidGrid(grid [][]int) bool {
  start := []int{0, 0}

  return checkPoint(grid, start, 0)
}

func main() {
  println(checkValidGrid([][]int{{0, 11, 16, 5, 20}, {17, 4, 19, 10, 15}, {12, 1, 8, 21, 6}, {3, 18, 23, 14, 9}, {24, 13, 2, 7, 22}}))
}
