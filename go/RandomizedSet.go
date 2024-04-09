import(
    "math/rand"
)

type RandomizedSet struct {
    Hash map[int]int
    List []int
}

func Constructor() RandomizedSet {
    return RandomizedSet{
        Hash: make(map[int]int),
    }
}

func (this *RandomizedSet) Insert(val int) bool {
    if _, ok := this.Hash[val]; !ok {
        this.List = append(this.List, val)
        this.Hash[val] = len(this.List) - 1
        return true
    }
    return false
}

func (this *RandomizedSet) Remove(val int) bool {
    if index, ok := this.Hash[val]; ok {
        delete(this.Hash, val)
        listLen := len(this.List)
        newList := make([]int, 0, listLen - 1)
        if index > 0 {
            newList = append(newList, this.List[:index]...)
            if listLen >= index + 2 {
                newList = append(newList, this.List[index+1:]...)
            }
        } else {
            if listLen >= index + 2 {
                newList = append(newList, this.List[index+1:]...)
            }
        }
        this.List = newList
        if len(this.List) >= index + 1 {
            for i, v := range this.List[index:] {
                this.Hash[v] = i + index
            }
        }

        return true
    }

    return false
}


func (this *RandomizedSet) GetRandom() int {
    return this.List[rand.Int63n(int64(len(this.List)))]
}


/**
 * Your RandomizedSet object will be instantiated and called as such:
 * obj := Constructor();
 * param_1 := obj.Insert(val);
 * param_2 := obj.Remove(val);
 * param_3 := obj.GetRandom();
 */
