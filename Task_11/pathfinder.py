from random import random
from collections import deque


class Pathfinder:
    
    grid = [
     [0,1,0,1,1,0,1,0,1,0],
     [0,1,0,0,0,0,1,0,1,0],
     [0,1,1,0,1,0,1,0,0,0],
     [0,0,0,1,1,0,1,1,1,0],
     [0,1,0,0,0,0,0,0,1,0],
     [0,1,0,1,1,1,1,0,1,0],
     [0,1,0,0,1,0,1,0,0,0],
     [0,1,0,0,1,0,1,0,1,0],
     [0,1,0,0,1,0,0,0,1,0],
     [0,1,0,0,1,0,1,1,1,0],
     ]

    cols = len(grid)
    rows = len(grid[0])


    def __init__(self,start,goal):
        self.start = start
        self.goal = goal



    def get_next_nodes(self, x, y):
        check_next_node = lambda x, y: True if 0 <= x < self.cols and 0 <= y < self.rows and not self.grid[y][x] else False
        ways = [-1, 0], [0, -1], [1, 0], [0, 1]
        return [(x + dx, y + dy) for dx, dy in ways if check_next_node(x + dx, y + dy)]



    def bfs(self, start, goal, graph):
        queue = deque([start])
        visited = {start: None}

        while queue:
            cur_node = queue.popleft()
            if cur_node == goal:
                break

            next_nodes = graph[cur_node]
            for next_node in next_nodes:
                if next_node not in visited:
                    queue.append(next_node)
                    visited[next_node] = cur_node

        return queue, visited


    def getGraph(self):
        graph = {}
        for y, row in enumerate(self.grid):
            for x, col in enumerate(row):
                if not col:
                    graph[(x, y)] = graph.get((x, y), []) + self.get_next_nodes(x, y)
        return graph


    def getPath(self):

        graph = self.getGraph()
        start = self.start 
        goal = self.goal 
        queue = deque([start])
        result = []

        while queue:
            queue, visited = self.bfs(start, goal, graph)
            path_head, path_segment = goal, goal
            while path_segment and path_segment in visited:
                path_segment = visited[path_segment]
                if path_segment:
                    result.insert(0,path_segment) 
            break

        return result


    def showGrid(self):
        for i in self.grid:
            for j in i:
                print(j,end=" ")
            print()

    def generateNewGrid(self,rows=10,cols=10):
        self.grid = [[1 if random() < 0.2 else 0 for col in range(cols)] for row in range(rows)]


    def changeSearchArg(self,start,goal):
        self.start = start
        self.goal = goal


if __name__ == "__main__":
    start = (0,0)
    finish = (9,9)
    result = Pathfinder(start,finish)
    result.generateNewGrid()
    result.showGrid()
    print(result.getPath())
    


    