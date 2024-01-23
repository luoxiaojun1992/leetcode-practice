package main

func simplifyPath(path string) string {
    var stack []string
    var tmpDir string
    for _, c := range path {
        if c == '/' {
            if len(tmpDir) > 0 {
                if tmpDir == ".." {
                    if len(stack) > 0 {
                        stack = stack[:len(stack) - 1]
                    }
                } else {
                    if tmpDir != "." {
                        stack = append(stack, tmpDir)
                    }
                }
                tmpDir = ""
            }
        } else {
            tmpDir += string(c)
        }
    }

    if len(tmpDir) > 0 {
        if tmpDir == ".." {
            if len(stack) > 0 {
                stack = stack[:len(stack) - 1]
            }
        } else {
            if tmpDir != "." {
                stack = append(stack, tmpDir)
            }
        }
        tmpDir = ""
    }

    newPath := strings.Join(stack, "/")
    if strings.HasPrefix(path, "/") {
        newPath = "/" + newPath
    }

    return newPath
}
