#!/bin/bash

# Функція для друку центрування рядка
print_centered_line() {
  local total_width=$1
  local line_chars="$2"
  local line_len=$3
  local padding=$(( (total_width - line_len) / 2 ))
  printf "%*s" "$padding" ""
  printf "%s\n" "$line_chars"
}

# Перевірка кількості аргументів
if [[ $# -ne 2 ]]; then
  echo "Використання: $0 <висота> <ширина_снігу>" >&2
  exit 1
fi

height=$1
snow_width=$2

# Перевірка на додатні цілі числа
if (( height <= 0 || snow_width <= 0 )); then
  echo "Аргументи мають бути додатніми цілими числами!" >&2
  exit 1
fi

# Фіксовані параметри
trunk_height=2
trunk_width=3
snow_height=1

# Скільки рядків іде на гілки
branches_total=$(( height - trunk_height - snow_height ))
if (( branches_total < 1 )); then
  echo "Висота ($height) надто мала: має бути щонайменше 3 (гілки + стовбур + сніг)." >&2
  exit 2
fi

# Розбиваємо гілки на два яруси
first_tier_height=$(( (branches_total + 1) / 2 ))
second_tier_height=$(( branches_total / 2 ))

# Малювання першого ярусу (починаємо з ширини 1)
width=1
for ((i = 1; i <= first_tier_height; i++)); do
  if (( i % 2 == 1 )); then
    # непарний рядок → усі "*"
    line_chars=$(printf '%*s' "$width" | tr ' ' '*')
  else
    # парний рядок → усі "#"
    line_chars=$(printf '%*s' "$width" | tr ' ' '#')
  fi
  print_centered_line "$snow_width" "$line_chars" "$width"
  width=$(( width + 2 ))
done

# Малювання другого ярусу (починаємо з ширини 3)
width=3
for ((j = 1; j <= second_tier_height; j++)); do
  if (( j % 2 == 1 )); then
    # непарний рядок → усі "#"
    line_chars=$(printf '%*s' "$width" | tr ' ' '#')
  else
    # парний рядок → усі "*"
    line_chars=$(printf '%*s' "$width" | tr ' ' '*')
  fi
  print_centered_line "$snow_width" "$line_chars" "$width"
  width=$(( width + 2 ))
done

# Малювання стовбура (завжди 2 рядки "###")
for ((t = 0; t < 2; t++)); do
  print_centered_line "$snow_width" "###" "$trunk_width"
done

# Малювання шару снігу (1 рядок, усі "*" по всій ширині)
snow_line=$(printf '%*s' "$snow_width" | tr ' ' '*')
print_centered_line "$snow_width" "$snow_line" "$snow_width"






