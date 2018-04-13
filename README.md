<div style="text-align:center">
 <img src="https://raw.githubusercontent.com/baloise/EVA/master/img/logo/eva/eva_logoPNG.PNG" />
</div>
<br/>

# EVA
Evaluation-Tool for trainees
Dieses Tool wird ab Sommer 2018 produktiv in der Baloise zur Berechnung des Leistungslohns der Lehrlinge im KV und der IT verwendet (Unter dem Namen Cash-Calculator). Dazu werden verschiedene Faktoren zur Lohnberechnung berücksichtigt, wie z.B. die Schulische und Betriebliche Leistung. Das Tool rechnet im Anschluss das Gesamtresultat aus und gibt anhand einer Abhängigkeit den entsprechend festgelegten Leistungslohn zurück.

Zusätzlich besteht die Möglichkeit, unterschiedliche Sprachen zu verwenden, sowie allgemeine Infos wie z.B. Reglemente oder einen Glossar für Lehrlinge und Praxisausbildende zur Verfügung zu stellen.

Dank der Modul-Struktur, welche ausschliesslich mit Vanilla-PHP und Javascript realisiert wurde, ist es problemlos möglich auch im nachhinein weitere Seiten/Module hinzuzufügen, welche Daten erfassen oder auswerten. Für die Gestalltung wird hauptsächlich Bootstrap verwendet. Die Modul-Struktur funktioniert jedoch unabhängig vom Design und kann auch mit anderen Frameworks/Librarys verwendet werden.

Die (Daten-)Sicherheit wird durch Verwendung neuster Techniken wie Mysqli, und einer mehrfach abgesicherten Gruppenlogik gewährleistet. Es besteht somit die möglichkeit, für unterschiedliche Gruppen unterschiedliche Views in den einzelnen Modulen einzurichten.

Die aktuelle Version des Tools kann unter [evatool.herokuapp.com](https://evatool.herokuapp.com/) betrachtet/getestet werden.

# Anforderungen
 - `PHP 7.2.*` (Apache)
 - `MySql` (mit InnoDB)
 - `Mercury` oder entsprechenden Mailserver (optional für Mail-Funktionen)

# Manuelle Installation
Es besteht die Möglichkeit, das Tool im gegenwärtigen Zustand eigenständig zu nutzen. Dazu sind einzig folgende Schritte notwendig (lokale Installation):

1. [XAMPP](https://www.apachefriends.org/de/index.html) herunterladen und installieren
2. Mailserver (XAMPP -> Mercury) konfigurieren
3. Daten ins XAMPP Web-Verzeichnis kopieren & XAMPP Apache, MySql & Mercury starten
4. App im Browser aufrufen. Bei korrekter Konfiguration sollte sich die DB von alleine initialisieren. Ansonsten unter `database/connect.php` einstellen.

Es besteht die Möglichkeit einer individuellen, auf die Bedürfnisse und Anforderungen des Betriebs angepassten Version des Tools. [-> Kontaktaufnahme](https://eliareutlinger.ch/#contact)

# Impressionen
<br/>
<div style="text-align:center">
 <b>Dashboard</b>
 <img src="https://raw.githubusercontent.com/baloise/EVA/master/img/impressions/dashboard.PNG" />
</div>

<br/>
<div style="text-align:center">
 <b>Benutzerverwaltung</b>
 <img src="https://raw.githubusercontent.com/baloise/EVA/master/img/impressions/benutzer.PNG" />
</div>

<br/>
<div style="text-align:center">
 <b>Lohnberechnung</b>
 <img src="https://raw.githubusercontent.com/baloise/EVA/master/img/impressions/leistungslohn.PNG" />
</div>
