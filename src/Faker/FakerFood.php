<?php
namespace App\Faker;

class FakerFood extends \Faker\Provider\Base
{
    protected static $imeHrane = [
        'Pizza sa sirom', 
        'Hamburger',
        'Cheeseburger',
        'Piletina na žaru',
        'Svinjski odrezak',
        'Goveđi odrezak',
        'Kebab',
        'Punjena pljeskavica',
        'Sarma',
        'Sendvič',
        'Bečki šnicl',
        'Juha sa rezancima',
        'Grah',
        'Riblja juha',
        'Gulaš',
    ];

    protected static $kategorijaJela = [
        'Pekarski proizvodi',
        'Žitarice',
        'Mliječni proizvodi',
        'Jestive biljke',
        'Jestive gljive',
        'Jestivi orašasti plodovi i sjemenke',
        'Mahunarke',
        'Meso',
        'Morska hrana',
        'Brza hrana',
    ];

    protected static $imeSastojka = [
        'Piletina',
        'Slanina',
        'Kobasica',
        'Govedina',
        'Crveni luk',
        'Češnjak',
        'Rajčica',
        'Krumpir',
        'Mrkva',
        'Brokula',
        'Kukuruz',
        'Špinat',
        'Čili',
        'Krastavac',
    ];

    protected static $oznakaHrane = [
        'Bez glutena',
        'Eco hrana',
        'Veganska hrana',
        '100% organska hrana',
        'Svježa hrana',
        'Sirova hrana',
        'Zdrava hrana',
        'Organska hrana',
        'Prirodna hrana',
    ];

    /**
     * @return string
     */
    public function imeHrane()
    {
        return static::randomElement(static::$imeHrane);
    }

    /**
     * A random Beverage Name.
     * @return string
     */
    public function kategorijaJela()
    {
        return static::randomElement(static::$kategorijaJela);
    }

    /**
     * @return string
     */
    public function imeSastojka()
    {
        return static::randomElement(static::$imeSastojka);
    }

    /**
     * @return string
     */
    public function oznakaHrane()
    {
        return static::randomElement(static::$oznakaHrane);
    }
}
