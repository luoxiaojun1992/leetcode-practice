package main

func isValid(s string) bool {
    var stack []string
    var matched = true

    for _, char := range s {
        charStr := string(char)

        if (charStr == "(") || (charStr == "{") || (charStr == "[") {
            stack = append(stack, charStr)
        }

        if (charStr == ")") {
            stackSize := len(stack)
            if (stackSize > 0) && (stack[stackSize - 1] == "(") {
                stack = stack[:stackSize - 1]
            } else {
                matched = false
            }
        }
        if (charStr == "}") {
            stackSize := len(stack)
            if (stackSize > 0) && (stack[stackSize - 1] == "{") {
                stack = stack[:stackSize - 1]
            } else {
                matched = false
            }
        }
        if (charStr == "]") {
            stackSize := len(stack)
            if (stackSize > 0) && (stack[stackSize - 1] == "[") {
                stack = stack[:stackSize - 1]
            } else {
                matched = false
            }
        }
    }

    return matched && (len(stack) == 0)
}
