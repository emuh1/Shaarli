<?php

require_once 'tests/UtilsTest.php';


class UtilsDeTest extends UtilsTest
{
    /**
     * Test date_format().
     */
    public function testDateFormat()
    {
        $date = DateTime::createFromFormat('Ymd_His', '20170101_101112');
        $this->assertRegExp('/1. Januar 2017 (um )?10:11:12 GMT\+0?3(:00)?/', format_date($date, true));
    }

    /**
     * Test date_format() using builtin PHP function strftime.
     */
    public function testDateFormatDefault()
    {
        $date = DateTime::createFromFormat('Ymd_His', '20170101_101112');
        $this->assertEquals('So 01 Jan 2017 10:11:12 EAT', format_date($date, false));
    }

    /**
     * Test autoLocale with a simple value
     */
    public function testAutoLocaleValid()
    {
        $current = setlocale(LC_ALL, 0);
        $header = 'en-us';
        autoLocale($header);
        $this->assertEquals('en_US.utf8', setlocale(LC_ALL, 0));

        setlocale(LC_ALL, $current);
    }

    /**
     * Test autoLocale with an alternative locale value
     */
    public function testAutoLocaleValidAlternative()
    {
        $current = setlocale(LC_ALL, 0);
        $header = 'en_us.UTF8';
        autoLocale($header);
        $this->assertEquals('en_US.utf8', setlocale(LC_ALL, 0));

        setlocale(LC_ALL, $current);
    }

    /**
     * Test autoLocale with multiples value, the first one is valid
     */
    public function testAutoLocaleMultipleFirstValid()
    {
        $current = setlocale(LC_ALL, 0);
        $header = 'en-us,de-de';
        autoLocale($header);
        $this->assertEquals('en_US.utf8', setlocale(LC_ALL, 0));

        setlocale(LC_ALL, $current);
    }

    /**
     * Test autoLocale with multiples value, the second one is valid
     */
    public function testAutoLocaleMultipleSecondValid()
    {
        $current = setlocale(LC_ALL, 0);
        $header = 'pt_BR,fr-fr';
        autoLocale($header);
        $this->assertEquals('fr_FR.utf8', setlocale(LC_ALL, 0));

        setlocale(LC_ALL, $current);
    }

    /**
     * Test autoLocale without value: defaults to en_US.
     */
    public function testAutoLocaleBlank()
    {
        $current = setlocale(LC_ALL, 0);
        autoLocale('');
        $this->assertEquals('en_US.utf8', setlocale(LC_ALL, 0));

        setlocale(LC_ALL, $current);
    }

    /**
     * Test autoLocale with an invalid value: defaults to en_US.
     */
    public function testAutoLocaleInvalid()
    {
        $current = setlocale(LC_ALL, 0);
        autoLocale('pt_BR');
        $this->assertEquals('en_US.utf8', setlocale(LC_ALL, 0));

        setlocale(LC_ALL, $current);
    }
}
