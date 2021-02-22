<?php

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
     * Badhalu.
     *
     * @param $number
     * @return string
     */
    public function badhalu($number): string
    {
        $number = (int)$number;

        if ($number < 1000) {
            return $this->haasSub($number);
        } else {
            return $this->haasMathi($number);
        }
    }

    /**
     * Haas sub.
     *
     * @param $number
     * @return string
     */
    private function haasSub($number): string
    {
        $number = (int)$number;
        $satheyka = "ސަތޭކަ ";

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
                $satheyka = "ސައްތަ ";
            }
            if ($rem == 0) {
                return $this->ehbari[$dig] . $satheyka;
            } else {
                return $this->ehbari[$dig] . $satheyka . $this->haasSub((string)$rem);
            }
        }
    }

    /**
     * Haas buri.
     *
     * @param $number
     * @return array
     */
    private function haasBuri($number): array
    {
        $arrHaas = [];

        while ($number != 0) {
            $arrHaas[] = $number % 1000;
            $number = round(floor($number / 1000), 0);
        }

        return $arrHaas;
    }

    /**
     * Haas mathi.
     *
     * @param $number
     * @return string
     */
    private function haasMathi($number): string
    {
        $number = (int)$number;
        $arrZero = $this->haasBuri($number);
        $lenArr = count($arrZero) - 1;
        $resArr = [];

        foreach (array_reverse($arrZero) as $value) {
            $wrd = $this->haasSub((string)$value) . " ";
            $zap = $this->sunbari[$lenArr] . " ";

            if ($wrd == " ") {
                break;
            } else if ($wrd == "ސުން ") {
                $wrd = "";
                $zap = "";
            }

            $resArr[] = $wrd . $zap;
            $lenArr -= 1;
        }

        $res = implode("", $resArr);

        if ($res[-1] == ",") {
            $res = $res[-1];
        }

        return $res;
    }
}

$input = "2500";
$numberToThaana = new NumberToThaana();
$output = $numberToThaana->badhalu($input);

print_r("Input: " . $input . "\n");
print_r("Output: " . html_entity_decode($output) . "\n");
