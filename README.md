# Mstudio Contao Dashboard

Ein schlankes Dashboard für Contao CMS, das Ihre **Backend-Favoriten** als ansprechende Kacheln auf der Backend-Startseite anzeigt.

## Funktionen

- 📊 **Favoriten-Integration** - Nutzt die native Contao 5.x Favoriten-Funktion
- 🎨 **Moderne Gestaltung** mit Hover-Effekten und responsivem Grid-Layout
- 🎯 **Smarte Icon-Zuordnung** - Automatische Icon-Auswahl basierend auf Modulnamen
- 👤 **Benutzerindividuell** - Jeder Benutzer sieht seine eigenen Favoriten
- 📱 **Responsive** für mobile Endgeräte optimiert
- 🔄 **Live-Synchronisation** - Änderungen an Favoriten erscheinen sofort
- ⚡ **Native Integration** - Erweitert die Standard-Backend-Startseite

## Systemanforderungen

- PHP 8.1 oder höher
- Contao 5.6 oder höher

## Installation

### Via Composer (empfohlen)

```bash
composer require mstudio/contao-dashboard
```

### Via Contao Manager

1. Suchen Sie im Contao Manager nach `mstudio/contao-dashboard`
2. Installieren Sie die Erweiterung
3. Führen Sie die Datenbankaktualisierung durch

## Nutzung

### Favoriten als Kacheln

1. **Favoriten setzen**: Im Backend auf das ⭐-Symbol neben einem Menüpunkt klicken
2. **Backend öffnen**: Die Favoriten-Kacheln erscheinen automatisch auf der Startseite
3. **Kacheln nutzen**: Klicken Sie auf eine Kachel, um zum jeweiligen Modul zu gelangen

Das Dashboard zeigt automatisch alle Ihre Favoriten als übersichtliche Kacheln oberhalb der Standard-Backend-Widgets (System-Meldungen, Shortcuts, Letzte Änderungen).

### Favoriten verwalten

Die Kacheln werden automatisch aus Ihren **Contao-Favoriten** generiert:

- Im Backend das ⭐-Symbol neben Menüpunkten anklicken
- Favoriten per Drag & Drop in der Favoriten-Verwaltung sortieren
- Favoriten-Ordner werden ignoriert (nur direkte Links werden angezeigt)

### Automatische Icon-Zuordnung

Das Dashboard wählt automatisch passende Icons basierend auf dem Modulnamen:

- **Direkte Zuordnung** für 30+ häufige Contao-Module
- **Pattern-basierte Erkennung** für unbekannte Module
- **Kategorien**: Content, News, Calendar, Files, Forms, Users, Mail, Design, Images, Code, Settings

#### Verfügbare Icons

- 🏠 home.svg - Seiten, Artikel
- 📰 news.svg - News, Newsletter, Blog
- 📅 calendar.svg - Kalender, Events
- 📥 download.svg - Dateien, Downloads
- 📝 form.svg - Formulare
- 👤 user.svg - Benutzer, Mitglieder
- ✉️ mail.svg - E-Mail, Newsletter, Kommentare
- 🎨 layout.svg - Themes, Layouts
- 🖼️ image.svg - Bilder, Galerien
- 💻 code.svg - Templates, Extensions
- ⚙️ settings.svg - Einstellungen, System
- 📊 dashboard.svg - Fallback

## Struktur

```
contao/
└── templates/
    └── backend/
        └── be_welcome.html5            # Template-Override mit Favoriten-Tiles
public/
└── icons/                              # Dashboard-Icons (12 SVG-Dateien)
src/
├── ContaoManager/
│   └── Plugin.php                      # Contao Manager Integration
└── MstudioContaoDashboardBundle.php    # Bundle-Definition
```

## Technische Details

- **Template-Override**: Überschreibt `be_welcome.html5` für native Integration
- **Favoriten-Integration**: Liest Favoriten aus `tl_favorites` Tabelle
- **Benutzerabhängig**: Jeder Backend-Benutzer hat individuelle Kacheln
- **Minimaler Footprint**: Keine Controller, keine Services, nur Template + Icons
- **Contao 5 kompatibel**: Nutzt aktuelle Contao-APIs

## Lizenz

MIT License

## Autor

**Markus Schnagl**  
✉️ [mail@mstudio.de](mailto:mail@mstudio.de)  
🌐 [mstudio.de](https://mstudio.de)

## Support

Bei Fragen oder Problemen können Sie:

- Ein Issue auf GitHub erstellen
- Eine E-Mail an [mail@mstudio.de](mailto:mail@mstudio.de) senden

## Changelog

### Version 1.0.0
- Initiales Release
- Dashboard-Tiles basierend auf Contao-Favoriten
- Native Integration in Backend-Startseite
- 12 Icons mit smarter Auto-Zuordnung
- Responsive Grid-Layout
- Contao 5.6+ Kompatibilität

## Mitwirken

Beiträge sind willkommen! Bitte erstellen Sie einen Pull Request oder öffnen Sie ein Issue für Vorschläge und Fehlermeldungen.

---

Entwickelt mit ❤️ von [mstudio](https://mstudio.de)
