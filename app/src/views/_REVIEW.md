# Marko, Lukas 25.4. 2023

[] zbytocne davate name componentu, vymaza, takze aj cely script vymazat, ak v nom nic nie je
[x] v template nepouzivat pred vue premennymi this (this.Data)
[x] zmenit naming metod a premennych dat relevantny podla ich funkcii a vyuzitia (napr. "Data" -> "copmanies")
[] za await axios nemusite davat uz then, pretoze vsetko co je potom v try pod requestom, tak sa vykona automaticky ak request zbehne, ak failne, tak sa fallbackne do catchu (by default)
    - ak toto zapracujete, tak treba vlozit cely ten await axios do konstantej premennej (const res = await axios)
[] 

HomePage.vue
[] header tag tu nema co robit
[] form 
    pros - prehladne
    cons - musis onsubmitom preventovat defaultne spravanie refreshu na submit
[] 
