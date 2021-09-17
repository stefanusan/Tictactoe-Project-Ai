<?php 
	class Hasil{
		public $index;
		public $statusAi;
		public $statusPlayer;
		public $full;

		function __construct($index, $statusAi, $statusPlayer, $full){
			$this->index = $index;
			$this->statusAi = $statusAi;
			$this->statusPlayer = $statusPlayer;
			$this->full = $full;
		}
	}
	class Node{
		public $heuristic;
		public $number;
		public $box;
		public $nextNode;
		public $index;

		public function __construct($box, $no, $index=0){
        	$this->box = array();
        	$this->box = $box;
        	$this->number = $no;
        	$this->nextNode = array();
        	$this->index = $index;
    	}

    	function printNode(){
    		echo "level Node: ". $this->number;
    		echo "<br>";
    		echo "heuristic: ". $this->heuristic;
    		echo "<br>";
    		echo "index: ". $this->index;
    		echo "<br>";
    		echo $this->box[1] ."  ". $this->box[2] ."  ". $this->box[3];
            echo "<br>";
            echo $this->box[4] ."  ". $this->box[5] ."  ". $this->box[6];
            echo "<br>";
            echo $this->box[7] ."  ". $this->box[8] ."  ". $this->box[9];
            echo "<br>";echo "<br>";
    	}

    	function isAvailable(){
    		$flag  = false;

    		for($i=1; $i<10; $i++){
    			if($this->box[$i] ==0){
    				$flag = true;
    				break;
    			}
    		}

    		//cek horizontal
    		if($this->box[1]==$this->box[2] && $this->box[2]== $this->box[3] && $this->box[1]!=0){
				return false;
			}

			if($this->box[4]==$this->box[5] && $this->box[5]== $this->box[6] && $this->box[5]!=0){
				return false;
			}

			if($this->box[7]==$this->box[8] && $this->box[8]== $this->box[9] && $this->box[8]!=0){
				return false;
			}
			//cek vertical
			if($this->box[1]==$this->box[4] && $this->box[4]== $this->box[7] && $this->box[4]!=0){
				return false;
			}
			if($this->box[2]==$this->box[5] && $this->box[5]== $this->box[8] && $this->box[5]!=0){
				return false;
			}
			if($this->box[3]==$this->box[6] && $this->box[6]== $this->box[9] && $this->box[6]!=0){
				return false;
			}

			//cek dogonal 1
			if($this->box[1]==$this->box[5] && $this->box[5]== $this->box[9] && $this->box[5]!=0){
				return false;
			}

			// cek diagonal 2
			if($this->box[3]==$this->box[5] && $this->box[5]== $this->box[7] && $this->box[5]!=0){
				return false;
			}

			return $flag;
    	}
    	// $cek == nilai yang akan di cek di kolom, misal mau cek AI maka nilai nya 1 enemy 2
    	// begitupun mau cek player, maka cek 2 enemy 1
    	function cekKolom($a, $b, $c, $cek, $enemy){
    		$value = 0;
    		$count = 0;
    		$status = true;

    		if($a==$cek) $count++;
    		if($b==$cek) $count++;
    		if($c==$cek) $count++;


    		if($a==$enemy) $status = false;
    		if($b==$enemy) $status = false;
    		if($c==$enemy) $status = false;

    		if($status){
    			if($count==1) $value +=1;
    			if($count==2) $value +=10;
    			if($count==3) $value +=100;
    		}

    		return $value;
    	}

    	function setHeuristic(){
    		$value = 0;
    		$tempBox = $this->box;

    		//cek AI horizontal
    		$value +=$this->cekKolom($tempBox[1], $tempBox[2], $tempBox[3], 1, 2);
    		$value +=$this->cekKolom($tempBox[4], $tempBox[5], $tempBox[6], 1, 2);
    		$value +=$this->cekKolom($tempBox[7], $tempBox[8], $tempBox[9], 1, 2);

    		// cek AI horizontal
    		$value +=$this->cekKolom($tempBox[1], $tempBox[4], $tempBox[7], 1, 2);
    		$value +=$this->cekKolom($tempBox[2], $tempBox[5], $tempBox[8], 1, 2);
    		$value +=$this->cekKolom($tempBox[3], $tempBox[6], $tempBox[9], 1, 2);

    		// cek AI Diagonal 1
    		$value +=$this->cekKolom($tempBox[1], $tempBox[5], $tempBox[9], 1, 2);
    		// cek AI diagonal 2
    		$value +=$this->cekKolom($tempBox[3], $tempBox[5], $tempBox[7], 1, 2);

    		//cek Player horizontal
    		$value +=-$this->cekKolom($tempBox[1], $tempBox[2], $tempBox[3], 2, 1);
    		$value +=-$this->cekKolom($tempBox[4], $tempBox[5], $tempBox[6], 2, 1);
    		$value +=-$this->cekKolom($tempBox[7], $tempBox[8], $tempBox[9], 2, 1);

    		// cek Player horizontal
    		$value +=-$this->cekKolom($tempBox[1], $tempBox[4], $tempBox[7], 2, 1);
    		$value +=-$this->cekKolom($tempBox[2], $tempBox[5], $tempBox[8], 2, 1);
    		$value +=-$this->cekKolom($tempBox[3], $tempBox[6], $tempBox[9], 2, 1);

    		// cek Player Diagonal 1
    		$value +=-$this->cekKolom($tempBox[1], $tempBox[5], $tempBox[9], 2, 1);
    		// cek Player diagonal 2
    		$value +=-$this->cekKolom($tempBox[3], $tempBox[5], $tempBox[7], 2, 1);



    		$this->heuristic = $value;

    	}

    	function isEmptyNextNode(){
    		return empty($this->nextNode);
    	}
	}

	class Gameplay{
		public $root;
		public $i;
		public function __construct($box){
			$this->root = new Node($box, 0);
			$this->i=0;
			$this->makeTree($box, $this->root, true, 2);

		}
		// membuat tree
		function makeTree($box, $node, $ai, $level){
			$levelNode = $node->number+1;
			if($level > 0 && $node->isAvailable()){
				if($ai){
					for($i=1; $i<10; $i++){
						$tempBox = $node->box;
						if($tempBox[$i] == 0){
							$tempBox[$i] = 1;
							array_push($node->nextNode, new Node($tempBox, $levelNode, $i));
							$this->makeTree($tempBox, end($node->nextNode), false, $level-1);
						}	
					}
				}
				else{
					for($i=1; $i<10; $i++){
						$tempBox = $node->box;
						if($tempBox[$i] == 0){
							$tempBox[$i] = 2;
							array_push($node->nextNode, new Node($tempBox, $levelNode, $i));
							$this->makeTree($tempBox, end($node->nextNode), true, $level-1);
						}	
					}

				}
			}
			else{
				$node->setHeuristic();
			}
		}

		//cek apakah box penuh
		function isFull($box){
			for($i=1; $i<10; $i++){
				if($box[$i] == 0){
					return false;
				}
			}

			return true;
		}

		
		function printAllNode($node){
			echo "node : ". $this->i . "<br>";
			$this->i +=1;
			$node->printNode();
			foreach ($node->nextNode as $data) {
				$this->printAllNode($data);
			}
		}

		function minFunction($node){

			if($node->isEmptyNextNode()){
				return $node->heuristic;
			}
			else{

				$node->heuristic = 10000;

				foreach ($node->nextNode as $data) {
					$node->heuristic = min($node->heuristic, $this->maxFunction($data));
				}
				return $node->heuristic;
			}
		}

		function maxFunction($node){

			if($node->isEmptyNextNode()){
				return $node->heuristic;
			}
			else{

				$node->heuristic = -10000;

				foreach ($node->nextNode as $data) {
					$node->heuristic = max($node->heuristic, $this->minFunction($data));
				}
				return $node->heuristic;
			}
		}

		function getBestMove(){
			$this->root->heuristic = $this->maxFunction($this->root);

			foreach ($this->root->nextNode as $data) {
				if($this->root->heuristic == $data->heuristic){
					$this->root->box = $data->box;
					$this->root->index = $data->index;
					break;
				}
			}
		}

		function printBestNode(){
			$this->root->printNode();
		}

		function cekWinorLoss($player, $number){
			//cek ai horizontal
			$status = "netral";
			if($this->root->box[1]==$this->root->box[2] && $this->root->box[2]== $this->root->box[3] && $this->root->box[1]==$number){
				return $player;
			}

			if($this->root->box[4]==$this->root->box[5] && $this->root->box[5]== $this->root->box[6] && $this->root->box[5]==$number){
				return $player;
			}

			if($this->root->box[7]==$this->root->box[8] && $this->root->box[8]== $this->root->box[9] && $this->root->box[8]==$number){
				return $player;
			}
			//cek ai vertical
			if($this->root->box[1]==$this->root->box[4] && $this->root->box[4]== $this->root->box[7] && $this->root->box[4]==$number){
				return $player;
			}
			if($this->root->box[2]==$this->root->box[5] && $this->root->box[5]== $this->root->box[8] && $this->root->box[5]==$number){
				return $player;
			}
			if($this->root->box[3]==$this->root->box[6] && $this->root->box[6]== $this->root->box[9] && $this->root->box[6]==$number){
				return $player;
			}

			//cek dogonal 1
			if($this->root->box[1]==$this->root->box[5] && $this->root->box[5]== $this->root->box[9] && $this->root->box[5]==$number){
				return $player;
			}

			// cek diagonal 2
			if($this->root->box[3]==$this->root->box[5] && $this->root->box[5]== $this->root->box[7] && $this->root->box[5]==$number){
				return $player;
			}

			return $status;
		}

	}

	//AI : 1
	// PLAYER : 2

	$box = array('1' => 0, '2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0);

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$box['1'] = $_POST['inpt1'];
		$box['2'] = $_POST['inpt2'];
		$box['3'] = $_POST['inpt3'];
		$box['4'] = $_POST['inpt4'];
		$box['5'] = $_POST['inpt5'];
		$box['6'] = $_POST['inpt6'];
		$box['7'] = $_POST['inpt7'];
		$box['8'] = $_POST['inpt8'];
		$box['9'] = $_POST['inpt9'];

	}
	
	$gamePlay = new Gameplay($box);
	//$gamePlay->printAllNode($gamePlay->root);
	$gamePlay->getBestMove();
	
	$resultAi = $gamePlay->cekWinorLoss("ai", 1);
	$resultPlayer = $gamePlay->cekWinorLoss("player", 2);
	$isFull = $gamePlay->isFull($gamePlay->root->box);
	$hasil = new Hasil($gamePlay->root->index, $resultAi, $resultPlayer, $isFull);

	// echo "<br> Best Move: <br>";
	// $gamePlay->printBestNode();
	echo json_encode($hasil);
 ?>