<?php
$PalindromeSearch = new PalindromeSearch('Аргентина манит негра');
$Palindrome = $PalindromeSearch->process();
echo '<b>Result: ' . $Palindrome . '</b>';

class PalindromeSearch{
	private $__phrase;

	private $__minPalindromeLength = 3;

	public function __construct($phrase){
		$this->__phrase = $phrase;
	}

	public function process(){
		$this->__clearPhrase();

		$PhraseLetters = preg_split("//u", $this->__phrase, -1, PREG_SPLIT_NO_EMPTY);

		foreach ($PhraseLetters as $i => $letter){
			$ReversePhraseLetters = array_reverse(array_slice($PhraseLetters, $i));

			foreach ($ReversePhraseLetters as $j => $letter){
				if (count($PhraseLetters) - ($j - $i )=== $this->__minPalindromeLength){
					break;
				}

				if ($this->__compareArrays(array_slice($PhraseLetters, $i), array_slice($ReversePhraseLetters, $j)) === true){
					return implode('', array_slice($PhraseLetters, $i));
				}
			}
		}

		return $this->__phrase[0];
	}

	private function __clearPhrase(){
		$this->__phrase = mb_strtolower(preg_replace('|\s+|', '', $this->__phrase), 'UTF-8');
	}


	private function __compareArrays($PhraseLetters, $ReversePhraseLetters){
		return $PhraseLetters === $ReversePhraseLetters;
	}
}
?>