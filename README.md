# Övningar för Lektion 9-10: Instagram och Twitter
Dags att missbruka några API:er!
## Övning 1
Använd bilderna på ditt Instagramkonto (eller ladda upp nya om du inte har några).
Hämta hem dina bilder och skapa en lämplig databastabell för dem.
Tabellen skapar du genom att göra en ny migration i Laravel.
## Övning 2
Gör ett bildgalleri på din sida med dina instagrambilder i.
Bilderna skall komma från din databas.
## Övning 3
Använd Twitters sök-API via https://api.twitter.com/1.1/search/tweets.json?q=<ditt sökord här>
Lagra tweets från responsen i din databas.
Skapa en tabell för dina tweets precis som du gjorde för dina instagrambilder.
## Övning 4
Analysera texterna från de tweets du hämtade hem och räkna ordförekomst.
Slutresultatet skall bli en lista med ord och en siffra för hur många gånger varje ord förekommer.
## Övning 5
Gör en lista med stoppord som skall exkluderas från textanalysen.
Implementera stopplistan så att dessa ord exkluderas från dina resultat.
## Övning 6
Gör en sida med ett formulär där man kan skriva in ett sökord.
När formuläret skickas in så skall tweets hämtas hem via sök-API:et och resultatet från textanalysen visas.
Gör en lista eller en tabell där orden listas tillsammans med hur många gånger de förekom.
Listan skall vara sorterad så att orden med flest träffar hamnar överst.