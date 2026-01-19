# Mstudio Contao Dashboard

Eine moderne Dashboard-Erweiterung für Contao CMS, die wichtige Backend-Aktionen als ansprechende Kacheln im Dashboard darstellt.

## Funktionen

- 📊 **Übersichtliches Dashboard** mit Kachel-Layout im Backend
- 🎨 **Moderne Gestaltung** mit Hover-Effekten und responsivem Design
- ⚡ **Schnellzugriff** auf wichtige Contao-Funktionen
- 🔧 **Dashboard-Widget** für wichtige Aktionen
- 🎯 **Vorkonfigurierte Aktionen** wie Startseite bearbeiten, News, Kalender, Downloads
- 📱 **Responsive** für mobile Endgeräte optimiert

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
```

Optional, falls öffentliche Ressourcen nicht automatisch verfügbar sind:

```bash
php vendor/bin/contao-console assets:install
```

### Via Contao Manager

1. Suchen Sie im Contao Manager nach `mstudio/contao-dashboard`
2. Installieren Sie die Erweiterung
3. Führen Sie die Datenbankaktualisierung durch

## Nutzung

Nach der Installation steht im Backend-Menü unter **System** ein neuer Menüpunkt **Dashboard** zur Verfügung.

### Verfügbare Dashboard-Kacheln

Das Dashboard zeigt standardmäßig folgende Kacheln:

- **Startseite bearbeiten** - Direkter Zugriff auf die Inhalte der Startseite
- **Aktuelles pflegen** - Verwaltung der News/Nachrichten
- **Termine eintragen** - Kalenderverwaltung
- **Downloads verwalten** - Dateiverwaltung

### Dashboard-Widget

Zusätzlich steht ein Dashboard-Widget für wichtige Aktionen zur Verfügung:

- Seitenstruktur
- Benutzerverwaltung
- Dateiverwaltung
- Einstellungen

## Anpassung

### Dashboard-Kacheln anpassen

Die Kacheln können durch Überschreiben des `DashboardController` angepasst werden:

```php
// src/Controller/CustomDashboardController.php
namespace App\Controller;

use Mstudio\ContaoDashboard\Controller\DashboardController;

class CustomDashboardController extends DashboardController
{
    protected function compile(): void
    {
        $this->Template->tiles = [
            [
                'label' => 'Ihre eigene Aktion',
                'icon'  => 'custom.svg',
                'href'  => 'contao?do=custom_module',
            ],
            // Weitere Kacheln...
        ];
    }
}
```

Registrieren Sie dann Ihren Controller in der `config.php`:

```php
// contao/config/config.php
$GLOBALS['BE_MOD']['system']['dashboard']['callback'] = 
    \App\Controller\CustomDashboardController::class;
```

### Template anpassen

Das Template `be_mstudio_dashboard.html5` kann im eigenen Theme-Ordner überschrieben werden:

```
templates/
    be_mstudio_dashboard.html5
```

### Styling anpassen

Die Styles können durch Überschreiben der CSS-Datei oder durch eigene Styles angepasst werden.

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
src/
├── ContaoManager/
│   └── Plugin.php                      # Contao Manager Integration
├── Controller/
│   └── DashboardController.php         # Hauptcontroller für Dashboard
├── DependencyInjection/
│   └── MstudioContaoDashboardExtension.php
├── Resources/
│   ├── config/
│   │   └── services.yaml               # Service-Definitionen
│   ├── contao/
│   │   ├── config/
│   │   │   └── config.php              # Backend-Modul-Registrierung
│   │   └── templates/
│   │       └── be_mstudio_dashboard.html5  # Backend-Template
│   └── public/
│       ├── css/
│       │   └── dashboard.css           # Dashboard-Styles
│       └── icons/                      # Icon-Verzeichnis
├── Widget/
│   └── ImportantActionsWidget.php      # Dashboard-Widget
└── MstudioContaoDashboardBundle.php    # Bundle-Definition
```

## Technische Details

- **Bundle-System**: Moderne Symfony-Bundle-Architektur
- **Service-Container**: Dependency Injection über services.yaml
- **PSR-4 Autoloading**: Vollständig PSR-4 konform
- **Contao 5 kompatibel**: Nutzt aktuelle Contao-APIs

## Lizenz

MIT License - siehe [LICENSE](LICENSE) für Details

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
- Dashboard mit Kachel-Layout
- Dashboard-Widget für wichtige Aktionen
- Responsive Design
- Contao 5.6+ Kompatibilität

## Mitwirken

Beiträge sind willkommen! Bitte erstellen Sie einen Pull Request oder öffnen Sie ein Issue für Vorschläge und Fehlermeldungen.

---

Entwickelt mit ❤️ von [mstudio](https://mstudio.de)
