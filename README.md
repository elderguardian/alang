<div align="center">
<img width="200" src="https://github.com/elderguardian/alang/assets/129489839/6fa76695-e4ec-4a7b-b07d-0e570d39506a">
<p>I don't know what I am doing</p>
<br>
</div>

## About alang
Alang lets you print characters in a very effortful way.
The syntax was created on paper in a five minute break in school.

## How does it work?
Imagine a long array of numbers where you start at position 0.
You can increase and decrease the values at the current position.
You can also go forward one position or go backwards.
If you know Brainfuck you should be familiar with this.

## Syntax

| Usage  | What does it do?                                                  |
|--------|-------------------------------------------------------------------|
| (AaAa) | Add one to number at current position in Binary (A=1, a=0)        |
| [AaAa] | Subtract one from number at current position in Binary (A=1, a=0) |
| .      | Print number at current position as large alphabet character      |
| ,      | Print number at current position as small alphabet character      |
| :      | Print number at current position                                  |
| ä      | Go forwards to the next position                                  |
| Ä      | Go backwards one position                                         |
| a      | Add one to number at current position                             |
| A      | Subtract one from number at current position                      |

## Running

```
php interpreter.php hello_world.alang 
```

## Example Hello World
```
(Aaaa).AAA,(AAA),,aaa,ä(AaAAA).Ä,aaa,[AAa],ääaaaa,
```
