<?php

namespace Mazin\Thaana;

class NumberToThaana
{
    /**
     * Ehbari.
     *
     * @var string[]
     */
    private $ehbari = [
        "ސުމެއް", "އެއް", "ދެ", "ތިން", "ހަތަރު", "ފަސް", "ހަ", "ހަތް", "އަށް", "ނުވަ", "ދިހަ", "އެގާރަ", "ބާރަ", "ތޭރަ", "ސާދަ", "ފަނަރަ", "ސޯޅަ", "ސަތާރަ", "އަށާރަ", "ނަވާރަ", "ވިހި", "އެކާވީސް", "ބާވީސް", "ތޭވީސް", "ސައުވީސް", "ފަންސަވީސް", "ސައްބީސް", "ހަތާވީސް", "އަށާވީސް", "ނަވާވީސް"
    ];

    /**
     * Dhihabari.
     *
     * @var string[]
     */
    private $dhihabari = [
        "ސުން", "ދިހަ", "ވިހި", "ތިރީސް", "ސާޅީސް", "ފަންސާސް", "ފަސްދޮޅަސް", "ހައްދިހަ", "އައްޑިހަ", "ނުވަދިހަ"
    ];

    /**
     * Sunbari.
     *
     * @var string[]
     */
    private $sunbari = [
        "", "ހާސް", "މިލިޔަން", "ބިލިޔަން", "ޓްރިލިޔަން"
    ];

    /**
     * Number.
     *
     * @var string
     */
    private $number = "";

    /**
     * NumberToThaana constructor.
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->number = $number;
    }

    /**
     * Convert.
     *
     * @return string|null
     */
    public function convert(): ?string
    {
        if (empty($this->number)) {
            return null;
        }

        $number = (int)$this->number;

        if ($number < 1000) {
            return $this->thousandSub($number);
        } else {
            return $this->thousandUp($number);
        }
    }

    /**
     * Thousand sub.
     *
     * @param $number
     * @return string
     */
    private function thousandSub($number): string
    {
        $number = (int)$number;
        $hundred = "ސަތޭކަ ";

        if ($number <= 0 || $number <= 29) {
            return $this->ehbari[$number];
        } else if ($number <= 30 || $number <= 99) {
            if ($number[-1] == "0") {
                return $this->dhihabari[(int)$number[0]];
            } else {
                return $this->dhihabari[(int)$number[0]] . " " . $this->ehbari[(int)$number[1]];
            }
        } else if ($number <= 100 || $number <= 999) {
            $rem = $number % 100;
            $dig = round(floor($number / 100), 0);

            if ($dig == 2) {
                $this->ehbari[2] = "ދުވި";
                $hundred = "ސައްތަ ";
            }
            if ($rem == 0) {
                return $this->ehbari[$dig] . $hundred;
            } else {
                return $this->ehbari[$dig] . $hundred . $this->thousandSub((string)$rem);
            }
        }

        return "";
    }

    /**
     * Thousand half.
     *
     * @param $number
     * @return array
     */
    private function thousandHalf($number): array
    {
        $thousandArray = [];

        while ($number != 0) {
            $thousandArray[] = $number % 1000;
            $number = round(floor($number / 1000), 0);
        }

        return $thousandArray;
    }

    /**
     * Thousand up.
     *
     * @param $number
     * @return string
     */
    private function thousandUp($number): string
    {
        $number = (int)$number;
        $thousandHalfArray = $this->thousandHalf($number);
        $thousandHalfArrayLength = count($thousandHalfArray) - 1;
        $responseArray = [];

        foreach (array_reverse($thousandHalfArray) as $value) {
            $word = $this->thousandSub((string)$value) . " ";
            $zap = $this->sunbari[$thousandHalfArrayLength] . " ";

            if ($word == " ") {
                break;
            } else if ($word == "ސުން ") {
                $word = "";
                $zap = "";
            }

            $responseArray[] = $word . $zap;
            $thousandHalfArrayLength -= 1;
        }

        $response = implode("", $responseArray);

        if ($response[-1] == ",") {
            $response = $response[-1];
        }

        return $response;
    }
}