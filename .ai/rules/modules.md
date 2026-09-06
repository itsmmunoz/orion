---
paths:
  - 'modules/**'
---

# Modules

## Modules live at project root under namespace Modules\
Module code (e.g. MoonLaunch) lives in `modules/` at the repo root (lowercase folder), not `app/`. Namespace is `Modules\MoonLaunch\...` (PSR-4 `"Modules\\": "modules/"` in composer.json). New modules must follow this convention.
