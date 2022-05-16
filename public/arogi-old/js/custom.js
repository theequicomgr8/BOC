$(document).ready(function(){
    $("#ddl_off_type").change(function(){
        var off_type_value=$("#ddl_off_type").val();
        if(off_type_value=="HQ") 
        {
            $("#ddl_rob_region").append('<option>----Select---</option><option id="patna"  value="1">PATNA</option>');
        }
        if(off_type_value=="FO") 
        {
            $("#ddl_rob_region").empty();
            $("#ddl_rob_region").append('<option>----Select---</option><option id="sitamarhi"  value="2">SITAMARHI</option><option id="bhagalpur" value="3">BHAGALPUR</option><option id="darbhanga" value="4">DARBHANGA</option><option id="chapra" value="5">CHAPRA</option><option id="munger" value="6">MUNGER</option>');
        }
    });


    //for Category under ICOP show
    $("#ddl_pro_activity").change(function(){
        var ddl_pro=$("#ddl_pro_activity").val();
        if(ddl_pro=='1' || ddl_pro=='2' || ddl_pro=='3' || ddl_pro=='4')
        {
            $("#icop").show();
        }
        else
        {
            $("#icop").hide();
        }

        // if(ddl_pro=='6' || ddl_pro=='5' || ddl_pro=='4' || ddl_pro=='3')
        // {
        //     $("#engagement,#five,#nine,#fixed").hide();
        // }

        if(ddl_pro=='6' || ddl_pro=='3' || ddl_pro=='4' || ddl_pro=='5')
        {
            // $("#engagement,#five").empty();
            $("#nine,#fixed").show();
            // $("#five").empty();
        }
        else
        {
            $("#engagement,#five").hide();
            // $("#five").detach();
        }

        if(ddl_pro=='6' || ddl_pro=='5')
        {
            $("#engagement").hide();
        }
        
    });

    $("#ddl_categ_icop").change(function(){
        var ddl_categ=$("#ddl_categ_icop").val();
        
        if(ddl_categ=="MI")
        {
            $("#engagement").show();
        }
        else{
            $("#engagement").hide();
        }

        if(ddl_categ=="SM")
        {  
            $("#five1").show();
            // alert($("#five1").html());
            // alert('small');
            // $("#nine").empty();
        }
        else
        {
            $("#five").hide();
        }

        if(ddl_categ=="ME" || ddl_categ=="BI" || ddl_categ=="OT")
        {  
            $("#nine").show();
            // $("#five").empty();
        }
        else
        {
            $("#nine").hide();
            // $("#five").detach();
        }

        if(ddl_categ=="MI" || ddl_categ=="SM" || ddl_categ=="ME" || ddl_categ=="BI" || ddl_categ=="OT")
        {
            $("#fixed").show();
        }

        

    });

    // $("#GridView2_ctl02_ch_main_event_activity").click(function(){
    //     $("#GridView2_ctl02_txt_main_no_program,#GridView2_ctl02_txt_main_remarl").removeAttr("disabled");
    //     // $("#GridView2_ctl02_txt_main_no_program,#GridView2_ctl02_txt_main_remarl").attr('data-id',1);
    // });

    // $("#GridView2_ctl03_ch_main_event_activity").click(function(){
    //     $("#GridView2_ctl03_txt_main_no_program,#GridView2_ctl03_txt_main_remarl").removeAttr("disabled");
    // });
    $(function () {

        //for nine
        $("#GridView1_ctl02_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl02_txt_prev9").show();
            } else {
                $("#GridView1_ctl02_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl03_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl03_txt_prev9").show();
            } else {
                $("#GridView1_ctl03_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl04_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl04_txt_prev9").show();
            } else {
                $("#GridView1_ctl04_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl05_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl05_txt_prev9").show();
            } else {
                $("#GridView1_ctl05_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl06_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl06_txt_prev9").show();
            } else {
                $("#GridView1_ctl06_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl07_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl07_txt_prev9").show();
            } else {
                $("#GridView1_ctl07_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl08_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl08_txt_prev9").show();
            } else {
                $("#GridView1_ctl08_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl09_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl09_txt_prev9").show();
            } else {
                $("#GridView1_ctl09_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl10_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl10_txt_prev9").show();
            } else {
                $("#GridView1_ctl10_txt_prev9").hide();
            }
        });


        //for five
        $("#GridView1_ctl02_ch_pre_event_activity1").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl02_txt_prev1").show();
            } else {
                $("#GridView1_ctl02_txt_prev1").hide();
            }
        });
        $("#GridView1_ctl03_ch_pre_event_activity1").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl03_txt_prev1").show();
            } else {
                $("#GridView1_ctl03_txt_prev1").hide();
            }
        });
        $("#GridView1_ctl04_ch_pre_event_activity1").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl04_txt_prev1").show();
            } else {
                $("#GridView1_ctl04_txt_prev1").hide();
            }
        });
        $("#GridView1_ctl05_ch_pre_event_activity1").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl05_txt_prev1").show();
            } else {
                $("#GridView1_ctl05_txt_prev1").hide();
            }
        });
        $("#GridView1_ctl06_ch_pre_event_activity1").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl06_txt_prev1").show();
            } else {
                $("#GridView1_ctl06_txt_prev1").hide();
            }
        });
        //for single
        // $("#GridView1_ctl02_ch_pre_event_activity_single").click(function () {
        //     if ($(this).is(":checked")) {
        //         // $("#GridView1_ctl02_txt_prev_single").show();
        //         $("#single").append('<textarea name="GridView1$ctl02$txt_prev_engagement" rows="2" cols="20" id="GridView1_ctl02_txt_prev_single" style="height:50px;width:450px;resize: none;">');
        //     } else {
        //         $("#single").empty();
        //     }
        // });
        $("#GridView1_ctl02_ch_pre_event_activity_single").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl02_txt_prev_single").show();
            } else {
                $("#GridView1_ctl02_txt_prev_single").hide();
            }
        });


        //for other
        $("#chkoth").click(function () {
            if ($(this).is(":checked")) {
                $("#other_field").show();
            } else {
                $("#other_field").hide();
            }
        });

        

       
        
        



        $("#GridView2_ctl02_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl02_txt_main_no_program,#GridView2_ctl02_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl02_txt_main_no_program,#GridView2_ctl02_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl03_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl03_txt_main_no_program,#GridView2_ctl03_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl03_txt_main_no_program,#GridView2_ctl03_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl04_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl04_txt_main_no_program,#GridView2_ctl04_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl04_txt_main_no_program,#GridView2_ctl04_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl05_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl05_txt_main_no_program,#GridView2_ctl05_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl05_txt_main_no_program,#GridView2_ctl05_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl06_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl06_txt_main_no_program,#GridView2_ctl06_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl06_txt_main_no_program,#GridView2_ctl06_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl07_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl07_txt_main_no_program,#GridView2_ctl07_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl07_txt_main_no_program,#GridView2_ctl07_txt_main_remarl").attr("disabled", "disabled");
            }
        });
                                                    
        $("#GridView2_ctl08_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl08_txt_main_no_program,#GridView2_ctl08_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl08_txt_main_no_program,#GridView2_ctl08_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl09_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl09_txt_main_no_program,#GridView2_ctl09_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl09_txt_main_no_program,#GridView2_ctl09_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl10_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl10_txt_main_no_program,#GridView2_ctl10_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl10_txt_main_no_program,#GridView2_ctl10_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl11_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl11_txt_main_no_program,#GridView2_ctl11_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl11_txt_main_no_program,#GridView2_ctl11_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl12_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl12_txt_main_no_program,#GridView2_ctl12_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl12_txt_main_no_program,#GridView2_ctl12_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl13_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl13_txt_main_no_program,#GridView2_ctl13_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl13_txt_main_no_program,#GridView2_ctl13_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl14_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl14_txt_main_no_program,#GridView2_ctl14_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl14_txt_main_no_program,#GridView2_ctl14_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl15_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl15_txt_main_no_program,#GridView2_ctl15_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl15_txt_main_no_program,#GridView2_ctl15_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl16_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl16_txt_main_no_program,#GridView2_ctl16_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl16_txt_main_no_program,#GridView2_ctl16_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl17_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl17_txt_main_no_program,#GridView2_ctl17_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl17_txt_main_no_program,#GridView2_ctl17_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl18_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl18_txt_main_no_program,#GridView2_ctl18_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl18_txt_main_no_program,#GridView2_ctl18_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl19_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl19_txt_main_no_program,#GridView2_ctl19_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl19_txt_main_no_program,#GridView2_ctl19_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl20_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl20_txt_main_no_program,#GridView2_ctl20_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl20_txt_main_no_program,#GridView2_ctl20_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl21_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl21_txt_main_no_program,#GridView2_ctl21_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl21_txt_main_no_program,#GridView2_ctl21_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl22_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl22_txt_main_no_program,#GridView2_ctl22_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl22_txt_main_no_program,#GridView2_ctl22_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl23_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl23_txt_main_no_program,#GridView2_ctl23_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl23_txt_main_no_program,#GridView2_ctl23_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl24_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl24_txt_main_no_program,#GridView2_ctl24_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl24_txt_main_no_program,#GridView2_ctl24_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl25_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl25_txt_main_no_program,#GridView2_ctl25_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl25_txt_main_no_program,#GridView2_ctl25_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl26_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl26_txt_main_no_program,#GridView2_ctl26_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl26_txt_main_no_program,#GridView2_ctl26_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl27_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl27_txt_main_no_program,#GridView2_ctl27_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl27_txt_main_no_program,#GridView2_ctl27_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl28_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl28_txt_main_no_program,#GridView2_ctl28_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl28_txt_main_no_program,#GridView2_ctl28_txt_main_remarl").attr("disabled", "disabled");
            }
        });


        // $("#GridView1_ctl02_ch_pre_event_activity").click(function () {
        //     if ($(this).is(":checked")) {
        //         $("#GridView1_ctl02_txt_prev").show();
        //         // alert('work');
        //     } else {
        //         // $("#GridView1_ctl02_txt_prev").hide();
        //         alert('not work');
        //     }
        //     // alert('work');
        // });
        
    });

    // $(function () {
    //     $("#GridView1_ctl02_ch_pre_event_activity9").click(function() {
    //         if($(this).is(":checked")) {
    //             $("#GridView1_ctl02_txt_prev9").show();
    //             // console.log('hello');
    //         } else {
    //             $("#GridView1_ctl02_txt_prev9").hide();
    //         }
    //     });
    // });

    

    
      

    var txt_sop_theme_err=true;
    var txt_no_covered_err=true;
    var txt_vilage_name_err=true;
    var txt_fund_sanc_err=true;
    var txt_officer_name=true;
    var txt_off_desig_err=true;
    var txt_off_loc_err=true;
    var txt_adv_amt_err=true;
    var txt_adv_pao_err=true;
    var txt_direct_pao_err=true;
    var txt_aud_size_err=true;
    var ddl_pro_activity_err=true;
    var ddl_off_type_err=true;
    var ddl_area_nature_err=true;
    var ddl_area_act_err=true;
    //theme field validation start
    $("#txt_sop_theme").blur(function(){
		check_theme();
	});
    
    function check_theme()
    {
        var theme= $("#txt_sop_theme").val();
        if(theme.length=="")
        {
            $("#txt_sop_theme_err").show();
            $("#txt_sop_theme_err").html("Please Fill This Field");
            txt_sop_theme_err=false;
            return false;
        }
        else
        {
            $("#txt_sop_theme_err").hide();
        }

        if((theme.length < 3) || (theme.length >20))
		{
			$("#txt_sop_theme_err").show();
			$("#txt_sop_theme_err").html("Theme Name Must Be Between 3 To 20 Character");
			txt_sop_theme_err=false;
			return false;
		}
		else
		{
			$("#txt_sop_theme_err").hide();
		}
    } 
    //theme field validation end
    
    //covered validation start
    $("#txt_no_covered").blur(function(){
		check_txt_no_covered();
	});
    
    function check_txt_no_covered()
    {
        var txt_no_covered= $("#txt_no_covered").val();
        if(txt_no_covered.length=="")
        {
            $("#txt_no_covered_err").show();
            $("#txt_no_covered_err").html("Please Fill This Field");
            txt_no_covered_err=false;
            return false;
        }
        else
        {
            $("#txt_no_covered_err").hide();
        }  
    } 
    //covered validation end


    //Name of Village validation start
    $("#txt_vilage_name").blur(function(){
		check_txt_vilage_name();
	});
    
    function check_txt_vilage_name()
    {
        var txt_vilage_name= $("#txt_vilage_name").val();
        if(txt_vilage_name.length=="")
        {
            $("#txt_vilage_name_err").show();
            $("#txt_vilage_name_err").html("Please Fill This Field");
            txt_vilage_name_err=false;
            return false;
        }
        else
        {
            $("#txt_vilage_name_err").hide();
        }
        if((txt_vilage_name.length < 3) || (txt_vilage_name.length >20))
        {
            $("#txt_vilage_name_err").show();
            $("#txt_vilage_name_err").html("Village Name Must Be 3 Character");
            txt_vilage_name_err=false;
            return false;
        }
        else
        {
            $("#txt_vilage_name_err").hide();
        }  
    } 
    //Name of Village validation end

    //Funds Allocated validation start
    $("#txt_fund_sanc").blur(function(){
		check_txt_fund_sanc();
	});
    
    function check_txt_fund_sanc()
    {
        var txt_fund_sanc= $("#txt_fund_sanc").val();
        if(txt_fund_sanc.length=="")
        {
            $("#txt_fund_sanc_err").show();
            $("#txt_fund_sanc_err").html("Please Fill This Field");
            txt_fund_sanc_err=false;
            return false;
        }
        else
        {
            $("#txt_fund_sanc_err").hide();
        }  
    }
    //Funds Allocated validation end

    //Name Of The Officer validation start
    $("#txt_officer_name").blur(function(){
		check_txt_officer_name();
	});
    
    function check_txt_officer_name()
    {
        var txt_officer_name= $("#txt_officer_name").val();
        if(txt_officer_name.length=="")
        {
            $("#txt_officer_name_err").show();
            $("#txt_officer_name_err").html("Please Fill This Field");
            txt_officer_name_err=false;
            return false;
        }
        else
        {
            $("#txt_officer_name_err").hide();
        }
        
        if((txt_officer_name.length < 3) || (txt_officer_name.length >20))
        {
            $("#txt_officer_name_err").show();
            $("#txt_officer_name_err").html("Officer Name Must Be 3 Character");
            txt_officer_name_err=false;
            return false;
        }
        else
        {
            $("#txt_officer_name_err").hide();
        }
    }
    //Name Of The Officer validation end

    //Designation Of The Officer validdation start
    $("#txt_off_desig").blur(function(){
		check_txt_off_desig();
	});
    
    function check_txt_off_desig()
    {
        var txt_off_desig= $("#txt_off_desig").val();
        if(txt_off_desig.length=="")
        {
            $("#txt_off_desig_err").show();
            $("#txt_off_desig_err").html("Please Fill This Field");
            txt_off_desig_err=false;
            return false;
        }
        else
        {
            $("#txt_off_desig_err").hide();
        }  
    }
    //Designation Of The Officer validdation end

    //location validation start
    $("#txt_off_loc").blur(function(){
		check_txt_off_loc();
	});
    
    function check_txt_off_loc()
    {
        var txt_off_loc= $("#txt_off_loc").val();
        if(txt_off_loc.length=="")
        {
            $("#txt_off_loc_err").show();
            $("#txt_off_loc_err").html("Please Fill This Field");
            txt_off_loc_err=false;
            return false;
        }
        else
        {
            $("#txt_off_loc_err").hide();
        }  
    }
    //location validation end

    //On-Account Advance validation start
    $("#txt_adv_amt").blur(function(){
		check_txt_adv_amt();
	});
    
    function check_txt_adv_amt()
    {
        var txt_adv_amt= $("#txt_adv_amt").val();
        if(txt_adv_amt.length=="")
        {
            $("#txt_adv_amt_err").show();
            $("#txt_adv_amt_err").html("Please Fill This Field");
            txt_adv_amt_err=false;
            return false;
        }
        else
        {
            $("#txt_adv_amt_err").hide();
        }  
    }
    //On-Account Advance validation end

    //Settlement of On-Account Advance validation start
    $("#txt_adv_pao").blur(function(){
		check_txt_adv_pao();
	});
    
    function check_txt_adv_pao()
    {
        var txt_adv_pao= $("#txt_adv_pao").val();
        if(txt_adv_pao.length=="")
        {
            $("#txt_adv_pao_err").show();
            $("#txt_adv_pao_err").html("Please Fill This Field");
            txt_adv_pao_err=false;
            return false;
        }
        else
        {
            $("#txt_adv_pao_err").hide();
        }  
    }
    //Settlement of On-Account Advance validation end

    //From1 validation start
    $("#txt_from").blur(function(){
		check_txt_from();
	});
    
    function check_txt_from()
    {
        var txt_from= $("#txt_from").val();
        if(txt_from.length=="")
        {
            $("#txt_from_err").show();
            $("#txt_from_err").html("Please Fill This Field");
            txt_from_err=false;
            return false;
        }
        else
        {
            $("#txt_from_err").hide();
        }  
    }
    //From1 validation end

    //To validation start
    $("#txt_to").focus(function(){
        var txt_from= $("#txt_from").val();

        if(txt_from.length=="")
        {
            $("#txt_to").attr("readonly", "readonly");
            $("#txt_to_err").show();
            $("#txt_to_err").html("Please First Select From Date");
            txt_to_err=false;
            return false;
        }
        else
        {
            $("#txt_to").removeAttr("readonly");
            $("#txt_to_err").hide();
        }


		$("#txt_to").attr('min',txt_from);
	});
    
    $("#txt_to").blur(function(){
		check_txt_to();
	});
    
    function check_txt_to()
    {
        var txt_to= $("#txt_to").val();
        if(txt_to.length=="")
        {
            $("#txt_to_err").show();
            $("#txt_to_err").html("Please Fill This Field");
            txt_to_err=false;
            return false;
        }
        else
        {
            $("#txt_to_err").hide();
        }  

        var txt_from= $("#txt_from").val();
        if(txt_to < txt_from)
        {
            $("#txt_to_err").show();
            $("#txt_to_err").html("Please Select Grater Then From Date");
            txt_to_err=false;
            return false;
        }
        else
        {
            $("#txt_to_err").hide();
        }
        
    }
    //To validation end


    //Approx Size Of Audience validation start
    $("#txt_aud_size").blur(function(){
		check_txt_aud_size();
	});
    
    function check_txt_aud_size()
    {
        var txt_aud_size= $("#txt_aud_size").val();
        if(txt_aud_size.length=="")
        {
            $("#txt_aud_size_err").show();
            $("#txt_aud_size_err").html("Please Fill This Field");
            txt_aud_size_err=false;
            return false;
        }
        else
        {
            $("#txt_aud_size_err").hide();
        }  
    }
    //Approx Size Of Audience validation end

    //Category Of Programme Activity validation start
    $("#ddl_pro_activity").on('blur change',function(){
		check_ddl_pro_activity();
	});
    function check_ddl_pro_activity()
    {
        var ddl_pro_activity=$("#ddl_pro_activity").val();
        if(ddl_pro_activity=="0")
        {
            $("#ddl_pro_activity_err").show();
            $("#ddl_pro_activity_err").html('Please Select Any One');
            ddl_pro_activity_err=false;
            return false;
        }
        else
        {
            $("#ddl_pro_activity_err").hide();
        }
        
    }
    //Category Of Programme Activity validation end

    //Office Type validation start
    $("#ddl_off_type").on('blur change', function(){
		check_ddl_off_type();
	});
    function check_ddl_off_type()
    {
        var ddl_off_type=$("#ddl_off_type").val();
        if(ddl_off_type=='0')
        {
            $("#ddl_off_type_err").show();
            $("#ddl_off_type_err").html('Please select Any One');
            ddl_off_type_err=false;
            return false;
        }
        else
        {
            $("#ddl_off_type_err").hide();
        }
        
    }
    //Office Type validation end

    //Demography validation start
    $("#ddl_area_nature").on('blur change',function(){
        check_ddl_area_nature();
    });
    function check_ddl_area_nature()
    {
        var ddl_area_nature=$("#ddl_area_nature").val();
        if(ddl_area_nature=='0')
        {
            $("#ddl_area_nature_err").show();
            $("#ddl_area_nature_err").html('Please Select Any One');
            ddl_area_nature_err=false;
            return false;
        }
        else
        {
            $("#ddl_area_nature_err").hide();
        }
    }
    //Demography validation end
    
    //Area of Activites validation start
    $("#ddl_area_act").on('blur change',function(){
        check_ddl_area_act();
    });
    function check_ddl_area_act()
    {
        var ddl_area_act=$("#ddl_area_act").val();
        if(ddl_area_act=='0')
        {
            $("#ddl_area_act_err").show();
            $("#ddl_area_act_err").html('Please Select Any One');
            ddl_area_act_err=false;
            return false;
        }
        else
        {
            $("#ddl_area_act_err").hide();
        }
    }
    //Area of Activites validation end


    $("#Form1").on("submit",function(e){
        e.preventDefault();
        txt_sop_theme_err=true;
        txt_no_covered_err=true;
        txt_vilage_name_err=true;
        txt_fund_sanc_err=true;
        txt_officer_name_err=true;
        txt_off_desig_err=true;
        txt_off_loc_err=true;
        txt_adv_amt_err=true;
        txt_adv_pao_err=true;
        txt_from_err=true;
        txt_to_err=true;
        txt_aud_size_err=true;
        ddl_pro_activity_err=true;
        ddl_off_type_err=true;
        ddl_area_nature_err=true;
        ddl_area_act_err=true;
        check_theme();
        check_txt_no_covered();
        check_txt_vilage_name();
        check_txt_fund_sanc();
        check_txt_officer_name();
        check_txt_off_desig();
        check_txt_off_loc();
        check_txt_adv_amt();
        check_txt_adv_pao();
        check_txt_from();
        check_txt_to(); 
        check_txt_aud_size();
        check_ddl_pro_activity();
        check_ddl_off_type();
        check_ddl_area_nature();
        check_ddl_area_act();
        if((txt_sop_theme_err==true) && (txt_no_covered_err==true) && (txt_vilage_name_err==true) && (txt_fund_sanc_err==true) && (txt_officer_name_err==true) && (txt_off_desig_err==true) && (txt_off_loc_err==true) && (txt_adv_amt_err==true) && (txt_adv_pao_err==true) && (txt_from_err==true) && (txt_to_err==true) && (txt_aud_size_err==true) && (ddl_pro_activity_err==true) && (ddl_off_type_err==true) && (ddl_area_nature_err==true) && (ddl_area_act_err==true))
        {
            // alert('working');
            $.ajax({
                url : "/rob-form-one",
                type: 'POST',
                 // headers: {
                //   'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                // },
                 // data: $("#personal_media").serialize(),
                 data : new FormData(this),
                 contentType: false,
                 cache : false,
                 processData:false,
                success:function(data)
                {
                    console.log(data);
                    // $("#msg_box").show();
                    // $("#Form1").trigger("reset");
                    // $("#insert_msg").html('Data Saved Success');
                    // top.location.href={{route('rob-form-two')}};
                    window.location ='rob-form-two';
                }
            });
             
        }
        
        
    });



    // $("#show").click(function(){
        
    // });
    
});