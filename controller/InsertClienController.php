<?php
	// Insert New Client
	// NOTE : trim,strip_tags,addslashes and real_escape_string functions are not used on Drop Downs Data and Dates
	public function clientUpd($busStatus,$CuID,$cName,$cAddr,$cnicNo,$cCity,$tou,$bussName,$ptclNo,$CellNo1,$rtoCno2,$bussAddr,$branchOff,$feeAppl,$classification,$rto,$bussCat,$fbrId,$pass,$pinC,$linked,$Cemail,/*$remRes,*/$NTNno,$NTNdor,$STRNno,$STRNdor,$whtAg,$WHTdor,$SRBno,$SRBdor,$BRBno,$BRBdor,$PRBno,$PRBdor){		
			if($busStatus != ""){
				// Extracting Business Status Array
				$CbusStatArr = explode("|", $busStatus);
				$CbusCatId = $CbusStatArr[0];
				$CbusCatNm = $CbusStatArr[1];

				$CuID = trim(strip_tags(addslashes($this->model->conn->real_escape_string($CuID))));
				if($cName != ""){
					if(preg_match("/^[a-zA-Z ]*$/", $cName)){
						$cAddr = trim(strip_tags(addslashes($this->model->conn->real_escape_string($cAddr))));
						if(preg_match("/^['0-9']*$/", $cnicNo)){
							if($cCity != ""){

								// Extracting City Array
								$cCityArr = explode("|", $cCity);
								$cCityId = $cCityArr[0];
								$cCityNm = $cCityArr[1];
								if($bussName != ""){

									if(filter_var($Cemail,FILTER_VALIDATE_EMAIL) || empty($Cemail)){

										// Extracting Tax Office Unit Array
										if($tou != ""){
											$touArr = explode("|", $tou);
											$touId = $touArr[0];
											$touNm = $touArr[1];
										}

										// Extracting Branch Office Array
										if($branchOff != ""){
											$brOffArr = explode("|", $branchOff);
											$brOffId = $brOffArr[0];
											$brOffNm = $brOffArr[1];
										}

										// Extracting Fees Applied
										if($feeAppl != ""){
											$feeAppl = $feeAppl;
										}

										// Extracting ROT Array
										if($rto != ""){
											$rtoArr = explode("|", $rto);
											$rtoId = $rtoArr[0];
											$rtoNm = $rtoArr[1];
										}

										// Extracting Business Category Array
										if($bussCat != ""){
											$busCatArr = explode("|", $bussCat);
											$busCatId = $busCatArr[0];
											$busCatNm = $busCatArr[1];
										}

										// Extracting Linked Account Array
										if($linked != ""){
											$linkedArr = explode("|", $linked);
											$linkedId = $linkedArr[0];
											$linkedNm = $linkedArr[1];
										}

										// Extracting With Holding Tax Agent
										if($whtAg != ""){
											$whtAg = $whtAg;
										}

										$bussName = trim(strip_tags(addslashes($this->model->conn->real_escape_string($bussName))));
										$ptclNo = trim(strip_tags(addslashes($this->model->conn->real_escape_string($ptclNo))));
										$CellNo1 = trim(strip_tags(addslashes($this->model->conn->real_escape_string($CellNo1))));
										$rtoCno2 = trim(strip_tags(addslashes($this->model->conn->real_escape_string($rtoCno2))));
										$bussAddr = trim(strip_tags(addslashes($this->model->conn->real_escape_string($bussAddr))));
										$classification = trim(strip_tags(addslashes($this->model->conn->real_escape_string($classification))));
										$fbrId = trim(strip_tags(addslashes($this->model->conn->real_escape_string($fbrId))));
										$pass = trim(strip_tags(addslashes($this->model->conn->real_escape_string($pass))));
										$pinC = trim(strip_tags(addslashes($this->model->conn->real_escape_string($pinC))));
										$linked = trim(strip_tags(addslashes($this->model->conn->real_escape_string($linked))));
										$Cemail = trim(strip_tags(addslashes($this->model->conn->real_escape_string($Cemail))));
										$remRes = trim(strip_tags(addslashes($this->model->conn->real_escape_string($remRes))));
										$NTNno = trim(strip_tags(addslashes($this->model->conn->real_escape_string($NTNno))));
										$STRNno = trim(strip_tags(addslashes($this->model->conn->real_escape_string($STRNno))));
										$whtAg = trim(strip_tags(addslashes($this->model->conn->real_escape_string($whtAg))));
										$SRBno = trim(strip_tags(addslashes($this->model->conn->real_escape_string($SRBno))));
										$BRBno = trim(strip_tags(addslashes($this->model->conn->real_escape_string($BRBno))));
										$PRBno = trim(strip_tags(addslashes($this->model->conn->real_escape_string($PRBno))));

										// Creating array for variables for sending in Database
										$varArr = array(
										'busStatId' => $CbusCatId,
										'busStatNm' => $CbusCatNm,
										'userId' => $CuID,
										'clientNm' => $cName,
										'clientAddr' => $cAddr,
										'cnicNo' => $cnicNo,
										'cityId' => $cCityId,
										'cityNm' => $cCityNm,
										'touId' => $touId,
										'touNm' => $touNm,
										'busNm' => $bussName,
										'ptclNo' => $ptclNo,
										'cellNo1' => $CellNo1,
										'cellNo2' => $rtoCno2,
										'busAddr' => $bussAddr,
										'boId' => $brOffId,
										'boNm' => $brOffNm,
										'feeAppl' => $feeAppl,
										'classification' => $classification,
										'rtoId' => $rtoId,
										'rtoNm' => $rtoNm,
										'busCatId' => $busCatId,
										'busCatNm' => $busCatNm,
										'fbrId' => $fbrId,
										'password' => $pass,
										'pinCd' => $pinC,
										'lnkId' => $linkedId,
										'lnkNm' => $linkedNm,
										'emId' => $Cemail,
										'remarks' => $remRes,
										'ntnNo' => $NTNno,
										'ntnDt' => $NTNdor,
										'strnNo' => $STRNno,
										'strnDt' => $STRNdor,
										'whAgt' => $whtAg,
										'whDt' => $WHTdor,
										'srbNo' => $SRBno,
										'srbDt' => $SRBdor,
										'brbNo' => $BRBno,
										'brbDt' => $BRBdor,
										'prbNo' => $PRBno,
										'prbDt' => $PRBdor
										// 'registerarId' => $;
										// 'registerarNm' => $;

										); 

										$nClientIns = $this->model->insert('client',$varArr);
										if($nClientIns == 1){
											echo "<div class='success-msg'>Record is inserted Successfully.</div>";
											header("refresh:3; url=index.php?page=nClient");	
										}else{
											$this->messages[] = "Record couldn't be inserted.";
										}
									}else{
										$this->messages[] = "Invalid e-mail <b>$Cemail</b>, please enter valid email address.";
									}
								}else{
									$this->messages[] = "Please fill Business Name.";
								}
							}else{
								$this->messages[] = "Please select a valid City Name";
							}
						}else{
							$this->messages[] = "Use Numeric 0-9 without dashes for CNIC";
						}
					}else{
						$this->messages[] = "Please use Alphabet for Client Name";
					}
				}else{
					$this->messages[] = "Please Fill Client Name.";
				}
			}else{
				$this->messages[] = "Please select a valid Business category.";
			}
		}
			?>