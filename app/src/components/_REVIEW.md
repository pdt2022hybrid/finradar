# Marko, Lukas 25.4. 2023

[] zbytocne davate name componentu, vymaza, takze aj cely script vymazat, ak v nom nic nie je
[] v template nepouzivat pred vue premennymi this (this.Data)
[] zmenit naming metod a premennych dat relevantny podla ich funkcii a vyuzitia (napr. "Data" -> "copmanies")
[] za await axios nemusite davat uz then, pretoze vsetko co je potom v try pod requestom, tak sa vykona automaticky ak request zbehne, ak failne, tak sa fallbackne do catchu (by default)