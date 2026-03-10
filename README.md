# Projekt

System do zarządzania meczami podczas turnieju siatkówki, umożliwiający obsługę drużyn, sędziów i turniejów w prosty i intuicyjny sposób.

---

## Spis treści
- [[#O projekcie]]
- [[#Aktualne funkcje]]
- [[#Plany rozwoju]]
- [[#Technologie]]
- [[#Instalacja]]

---

## O projekcie
Projekt pozwala w prosty sposób zarządzać meczami podczas turnieju siatkówki.  
Umożliwia prowadzenie tabel drużyn, zarządzanie sędziami oraz tworzenie turniejów z możliwością późniejszej edycji.  

---

## Aktualne funkcje
- **Drużyny:** dodawanie, usuwanie i edycja drużyn uczestniczących w turnieju. 
- **Sędziowie:** możliwość dodania, usunięcia i edycji sędziów.  
- **Turnieje:** dodawanie nowego turnieju z nazwą i datą, zmiana między turniejami.  

---

## Plany rozwoju
- **Losowanie meczów:** automatyczne losowanie drużyn i przydział sędziów (3 sędziów na mecz).  
- **Graficzna drabinka turniejowa:** wizualne przedstawienie rozgrywek, możliwość eksportu do PDF.  
- **Edycja meczów:** zmiana wyników i szczegółów meczu po jego dodaniu.  
- Rozbudowa statystyk i automatyczne aktualizacje tabel po zakończonych meczach.  

---

## Technologie
Projekt korzysta z następujących technologii:  
- **JavaScript** – interaktywność frontendu  
- **PHP** – obsługa logiki serwera i baz danych  
- **HTML / CSS** – struktura i wygląd strony  

---

## Instalacja  
Aby uruchomić projekt lokalnie:    
  
1. **Sklonuj repozytorium:**    
```bash  
git clone https://github.com/owcachixx/projekt.git
```
2. **Skopiuj projekt** do katalogu serwera (np. `htdocs` w XAMPP).
3. **Przygotuj bazę danych:**
    - Masz dwie opcje:
        1. **Przykładowa baza (`rozgrywki_przyklad.sql`)** – zawiera już drużyny i sędziów, idealna do szybkiego testowania.
        2. **Pusta baza (`rozgrywki.sql`)** – tylko struktura tabel, bez danych, jeśli chcesz rozpocząć od zera.
    - Zaimportuj wybraną bazę do swojej bazy MySQL / MariaDB.
    - Dostosuj połączenie z bazą w pliku `includes/database.php`, aby wskazywało na wybraną bazę.
4. **Uruchom serwer** (np. XAMPP) i otwórz projekt w przeglądarce:
http://localhost/projekt/index.html
5. Sprawdź, czy wszystkie tabele działają i czy można dodawać drużyny, sędziów i turnieje.
