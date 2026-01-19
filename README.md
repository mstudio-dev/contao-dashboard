# Mstudio Contao Dashboard

Eine moderne Dashboard-Erweiterung für Contao CMS, die Ihre **Backend-Favoriten** als ansprechende Kacheln auf der Startseite darstellt.

## Funktionen

- 📊 **Favoriten-Integration** - Nutzt die native Contao 5.x Favoriten-Funktion
- 🎨 **Moderne Gestaltung** mit Hover-Effekten und responsivem Design
- ⚡ **Automatische Startseite** - Dashboard wird beim Backend-Login angezeigt
- 👤 **Benutzerindividuell** - Jeder Benutzer sieht seine eigenen Favoriten
- 📱 **Responsive** für mobile Endgeräte optimiert
- 🔄 **Live-Synchronisation** - Änderungen an Favoriten erscheinen sofort

## Systemanforderungen

- PHP 8.1 oder höher
- Contao 5.6 oder höher

## Installation

### Via Composer (empfohlen)

```bash
composer require mstudio/contao-dashboard
```

Nach der Installation:

```bash
php vendor/bin/contao-console contao:migrate
php vendor/bin/contao-console assets:install
php vendor/bin/contao-console cache:clear
```

### Via Contao Manager

1. Suchen Sie im Contao Manager nach `mstudio/contao-dashboard`
2. Installieren Sie die Erweiterung
3. Führen Sie die Datenbankaktualisierung durch

## Nutzung

### Favoriten als Kacheln

1. **Favoriten setzen**: Im Backend auf das ⭐-Symbol neben einem Menüpunkt klicken
2. **Dashboard öffnen**: Das Dashboard wird automatisch als Startseite angezeigt
3. **Kacheln nutzen**: Klicken Sie auf eine Kachel, um zum jeweiligen Modul zu gelangen

Das Dashboard zeigt automatisch alle Ihre Favoriten als übersichtliche Kacheln an. Die Beschriftung und Reihenfolge entspricht Ihrer Favoriten-Konfiguration in Contao.

### Standard-Startseite

Das Dashboard wird automatisch als Backend-Startseite angezeigt. Beim Aufruf von `/contao` werden Sie direkt zum Dashboard weitergeleitet.

Sie können das Dashboard auch jederzeit über **System → Dashboard** im Backend-Menü aufrufen.

## Anpassung

### Kacheln verwalten

Die Kacheln werden automatisch aus Ihren **Contao-Favoriten** generiert:

- Im Backend das ⭐-Symbol neben Menüpunkten anklicken
- Favoriten per Drag & Drop in der Favoriten-Verwaltung sortieren
- Favoriten löschen über die Favoriten-Verwaltung

### Fallback-Kacheln (wenn keine Favoriten gesetzt)

Wenn ein Benutzer noch keine Favoriten gesetzt hat, werden Standard-Kacheln angezeigt. Diese können in `contao/config/config.php` angepasst werden:

```php
// contao/config/config.php

$GLOBALS['DASHBOARD_TILES'] = [
    [
        'label' => 'Seitenstruktur',
        'icon'  => 'home.svg',
        'href'  => 'contao?do=page',
    ],
    [
        'label' => 'Artikel',
        'icon'  => 'home.svg',
        'href'  => 'contao?do=article',
    ],
    // Weitere Kacheln...
];
```

### Template anpassen

Das Template `be_mstudio_dashboard.html5` kann im eigenen Theme-Ordner überschrieben werden:

```
templates/
    be_mstudio_dashboard.html5
```

## Lokale Entwicklung mit DDEV

Für die lokale Entwicklung mit DDEV folgen Sie der [offiziellen Contao-Dokumentation](https://docs.contao.org/5.x/manual/de/anleitungen/lokale-installation/ddev/#konfigurieren-eines-lokalen-pfades-als-ein-shared-repository-f%C3%BCr-alle-deine-bundles-innerhalb-des-ddev-containers).

### Schnellanleitung

1. Erstellen Sie `.ddev/docker-compose.bundles.yaml` in Ihrem Contao-Projekt:

```yaml
services:
  web:
    volumes:
      - /home/$USER/repository:/home/$USER/repository:rw
```

2. Legen Sie dieses Bundle in `/home/$USER/repository/contao-dashboard` ab.

3. Fügen Sie in der `composer.json` Ihres Contao-Projekts hinzu:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "~/repository/contao-dashboard",
            "options": {
                "symlink": true
            }
        }
    ]
}
```

4. Installieren Sie das Bundle:

```bash
ddev restart
ddev composer require mstudio/contao-dashboard:@dev
ddev exec console cache:clear
```

## Struktur

```
contao/
├── config/
│   └── config.php                      # Backend-Modul-Registrierung
└── templates/
    └── be_mstudio_dashboard.html5      # Dashboard-Template
public/
└── icons/                              # Dashboard-Icons
src/
├── ContaoManager/
│   └── Plugin.php                      # Contao Manager Integration
├── Controller/
│   └── DashboardController.php         # Dashboard-Controller
├── EventListener/
│   └── BackendMenuListener.php         # Automatische Weiterleitung
└── MstudioContaoDashboardBundle.php    # Bundle-Definition
```

## Technische Details

- **Favoriten-Integration**: Liest Favoriten aus `tl_favorites` Tabelle
- **Benutzerabhängig**: Jeder Backend-Benutzer hat individuelle Kacheln
- **Auto-Redirect**: EventSubscriber leitet Backend-Startseite zum Dashboard um
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
- Dashboard mit Kachel-Layout basierend auf Contao-Favoriten
- Automatische Backend-Startseite
- Responsive Design
- Contao 5.6+ Kompatibilität

## Mitwirken

Beiträge sind willkommen! Bitte erstellen Sie einen Pull Request oder öffnen Sie ein Issue für Vorschläge und Fehlermeldungen.

---

Entwickelt mit ❤️ von [mstudio](https://mstudio.de)
