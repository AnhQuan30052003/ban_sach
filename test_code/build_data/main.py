import os

os.system("cls")

# Tạo mã theo id nhận vào
def chuoi_so(id: int):
  lenChuan = 4
  lenNumber = len(str(id))

  text = ""
  for i in range(lenChuan - lenNumber):
    text += '0'
  text += str(id)

  return text

pathCur = os.path.abspath(os.path.dirname(__file__))
path = os.path.join(pathCur, "input.txt")

data = []
with open(path, "r") as file:
  for line in file:
    line = line.strip()
    data.append(line)

path = os.path.join(pathCur, "output.txt")
with open(path, "w") as file:
  for line in data:
    file.write(line)
    file.write("\n")

  start = 29
  end = 100
  end = 200
  index = 0
  for i in range(start, end + 1):
    id = chuoi_so(i)
    print(id)
    line = "('" + id + data[index][6:]
    print(line)
    file.write(line)
    file.write("\n")

    index += 1
    if index >= len(data):
      index = 0

print("Build done.")