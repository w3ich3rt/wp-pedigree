# Table schema

The table for the pedigree would be something like this:

```mermaid
    wp-pedigree-dogs {
        string name
        date birth
        string owner
        string breeder
        bool gender
        string color
        string HD_value
        string ED_value
        string notes
        bool fur_type
        bool champion
        bool multi
    }
```

## Description of the fields

- Name: The full name of the dog (with kennel)
- Birth: The day of the birth of the dog
- Owner: The current owner of the dog
- Breeder: The breeder of the dog
- Gender: Female (1) or Male (0)
- Color: The color of the fur
- HD: The HD values of the dog (Hip dysplasia)
- ED: The ED values of the dog (Elbow dysplasia)
- Notes: Further notes, something like more "Breeding conditions" or "Missing tooth"
- Fur type: The type of the fur (short hair (1) or long hair (0))
- Champion: Is the dog a champion? (Yes (1) or No (0))
- Multi Champion: Is the dog a multichampion? (Yes (1) or No (0))
