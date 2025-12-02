# 📱 Champ Téléphone - Entrée Numérique Uniquement

**Date**: 2 Décembre 2025  
**Status**: ✅ **IMPLÉMENTÉ**

---

## 🎯 Résumé

Le champ téléphone n'accepte maintenant **que des chiffres** de façon stricte et rigoureuse:
- ✅ Impossible de taper une lettre
- ✅ Impossible de coller du texte non-numérique
- ✅ Filtrage en temps réel
- ✅ Limite de 15 caractères maximum

---

## 🔒 Niveaux de protection

### **1. Type d'input**
```html
<input type="text" inputmode="numeric">
```
- `type="text"` permet le filtrage personnalisé
- `inputmode="numeric"` affiche le clavier numérique sur mobile

### **2. Événement @input**
```javascript
handlePhoneInput = (event) => {
    form.phone = form.phone.replace(/[^0-9]/g, '');
}
```
- Supprime tout caractère non-numérique
- En temps réel après chaque frappe

### **3. Événement @keypress**
```javascript
onlyNumbers = (event) => {
    const char = String.fromCharCode(event.which);
    if (!/[0-9]/.test(char)) {
        event.preventDefault();
    }
}
```
- Empêche la frappe de caractères non-numériques
- Bloque à la source (avant que le caractère n'entre)

### **4. Événement @paste**
```javascript
handlePhonePaste = (event) => {
    event.preventDefault();
    const pastedText = (event.clipboardData || window.clipboardData).getData('text');
    const numbersOnly = pastedText.replace(/[^0-9]/g, '');
    form.phone = numbersOnly.slice(0, 15);
}
```
- Filtre le texte collé
- N'accepte que les chiffres
- Limite à 15 caractères

### **5. Attribut maxlength**
```html
maxlength="15"
```
- Limite l'entrée à 15 caractères maximum
- Protection ultime contre les dépassements

---

## 🧪 Scénarios de test

### **Scénario 1: Taper des lettres**
```
Taper: a, b, c
Résultat: Aucun caractère n'apparaît
Bloquer par: @keypress
```

### **Scénario 2: Taper des chiffres**
```
Taper: 221777123456
Résultat: 221777123456 ✅
```

### **Scénario 3: Mélange de chiffres et lettres**
```
Taper: 221ABC777DEF123456
Résultat: 221777123456 ✅ (lettres supprimées)
```

### **Scénario 4: Copier-coller du texte mixte**
```
Coller: "221-777-123-456 Sénégal"
Résultat: "221777123456" ✅ (caractères spéciaux et texte supprimés)
```

### **Scénario 5: Copier-coller uniquement des chiffres**
```
Coller: "221777123456"
Résultat: "221777123456" ✅
```

### **Scénario 6: Dépasser 15 caractères**
```
Taper: "2217771234567890123"
Résultat: "221777123456789" (limité à 15)
```

---

## 📋 Code implémenté

### **HTML - Input**
```vue
<input
    id="phone"
    v-model="form.phone"
    type="text"
    inputmode="numeric"
    required
    autocomplete="tel"
    placeholder="221777123456"
    maxlength="15"
    @input="handlePhoneInput"
    @keypress="onlyNumbers"
    @paste="handlePhonePaste"
    class="..."
/>
```

### **JavaScript - Méthodes**
```javascript
// Filtre les caractères non-numériques après input
const handlePhoneInput = (event) => {
    form.phone = form.phone.replace(/[^0-9]/g, '');
};

// Bloque la frappe de non-chiffres
const onlyNumbers = (event) => {
    const char = String.fromCharCode(event.which);
    if (!/[0-9]/.test(char)) {
        event.preventDefault();
    }
};

// Filtre le texte collé
const handlePhonePaste = (event) => {
    event.preventDefault();
    const pastedText = (event.clipboardData || window.clipboardData).getData('text');
    const numbersOnly = pastedText.replace(/[^0-9]/g, '');
    form.phone = numbersOnly.slice(0, 15);
};
```

---

## ✨ Flux d'entrée

```
Utilisateur tape/colle
    ↓
@keypress: Bloque les non-chiffres
    ↓
@input: Filtre les caractères résiduels
    ↓
@paste: Filtre le texte collé
    ↓
maxlength: Limite à 15 caractères
    ↓
form.phone = chiffres uniquement ✅
```

---

## 🎯 Cas d'usage

### **Cas 1: Utilisateur normal**
```
Tape: 221777123456
Résultat: ✅ Accepté et traité normalement
```

### **Cas 2: Utilisateur maladroit avec clavier**
```
Tape: 221 777 123 456 (avec espaces)
Résultat: ✅ Espaces supprimés → 221777123456
```

### **Cas 3: Utilisateur mal intentionné (SQL injection)**
```
Colle: 221'; DROP TABLE users; --
Résultat: ✅ Converti en → 221
```

### **Cas 4: Format international avec +**
```
Tape: +221777123456
Résultat: ✅ Le + est supprimé → 221777123456
```

---

## 🔐 Sécurité

✅ **Protection contre l'injection SQL** - Uniquement des chiffres
✅ **Protection XSS** - Pas de balises HTML possibles
✅ **Validation côté client** - Filtrage immédiat
✅ **Validation côté serveur** - Double protection (regex)
✅ **Limite de caractères** - maxlength + slice()

---

## 📊 Comparaison avant/après

| Aspect | Avant | Après |
|--------|-------|-------|
| **Lettres acceptées** | ❌ Oui | ✅ Non (bloquées) |
| **Caractères spéciaux** | ❌ Oui | ✅ Non (filtrés) |
| **Copier-coller** | ❌ Pas contrôlé | ✅ Filtré |
| **Limite caractères** | ❌ Non | ✅ 15 max |
| **Protection** | ❌ Basique | ✅ Multicouche |

---

## 🎉 Status

```
✅ Blocage à la frappe (@keypress)
✅ Filtrage après input (@input)
✅ Filtrage du copier-coller (@paste)
✅ Limite de 15 caractères
✅ Clavier numérique sur mobile
✅ Protection multicouche
✅ PRÊT POUR PRODUCTION
```

---

**Version**: 2.0  
**Date**: 2 Décembre 2025  
**Status**: ✅ **PRODUCTION READY**

Le champ téléphone accepte maintenant **uniquement les chiffres** de façon stricte et sécurisée! 📱

