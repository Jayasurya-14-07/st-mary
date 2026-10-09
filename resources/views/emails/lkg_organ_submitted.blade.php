<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete LKG Organ Submission Details</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }

        .wrapper {
            width: 100%;
            padding: 20px 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .header {
            background: linear-gradient(135deg, #5d008c 0%, #3a0057 100%);
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .content {
            padding: 30px;
        }

        .section-header {
            background-color: #f1f5f9;
            padding: 10px 15px;
            font-weight: 700;
            font-size: 14px;
            color: #5d008c;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-left: 4px solid #39ff14;
            margin: 25px 0 15px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }

        th {
            width: 40%;
            font-weight: 600;
            color: #64748b;
            background-color: #fafafa;
        }

        td {
            font-weight: 500;
            color: #1e293b;
        }

        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
        }

        .status-on {
            color: #059669;
            font-weight: bold;
        }

        .status-off {
            color: #dc2626;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>Full Calibration Report: LKGB ORGANS</h1>
                <p style="margin-top:5px; font-size:14px; opacity:0.8;">Submission ID: #{{ $lkgOrgan->id }} |
                    {{ $lkgOrgan->created_at->format('M d, Y') }}
                </p>
            </div>
            <div class="content">

                <div class="section-header">1. Submitter Information</div>
                <table>
                    <tr>
                        <th>Name</th>
                        <td>{{ $lkgOrgan->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $lkgOrgan->email }}</td>
                    </tr>
                </table>

                <div class="section-header">General</div>
                <table>
                    <tr>
                        <th>2. Number of units per plate</th>
                        <td>{{ $lkgOrgan->no_of_units }}</td>
                    </tr>
                    <tr>
                        <th>3. Number of plates</th>
                        <td>{{ $lkgOrgan->no_of_plates }}</td>
                    </tr>
                    <tr>
                        <th>4. Liver</th>
                        <td class="{{ $lkgOrgan->flexRadioLiver ? 'status-on' : 'status-off' }}">
                            {{ $lkgOrgan->flexRadioLiver ? 'ENABLED' : 'DISABLED' }}
                        </td>
                    </tr>
                    <tr>
                        <th>5. Kidney</th>
                        <td class="{{ $lkgOrgan->flexRadioKidney ? 'status-on' : 'status-off' }}">
                            {{ $lkgOrgan->flexRadioKidney ? 'ENABLED' : 'DISABLED' }}
                        </td>
                    </tr>
                    <tr>
                        <th>6. Gut</th>
                        <td class="{{ $lkgOrgan->flexRadioGut ? 'status-on' : 'status-off' }}">
                            {{ $lkgOrgan->flexRadioGut ? 'ENABLED' : 'DISABLED' }}
                        </td>
                    </tr>
                    <tr>
                        <th>7. Brain</th>
                        <td class="{{ $lkgOrgan->flexRadioBrain ? 'status-on' : 'status-off' }}">
                            {{ $lkgOrgan->flexRadioBrain ? 'ENABLED' : 'DISABLED' }}
                        </td>
                    </tr>
                    <tr>
                        <th>9. Vascular region Liver</th>
                        <td class="{{ $lkgOrgan->vascularRadioLiver ? 'status-on' : 'status-off' }}">
                            {{ $lkgOrgan->vascularRadioLiver ? 'ENABLED' : 'DISABLED' }}
                        </td>
                    </tr>
                    <tr>
                        <th>10. Vascular region Kidney</th>
                        <td class="{{ $lkgOrgan->vascularRadioKidney ? 'status-on' : 'status-off' }}">
                            {{ $lkgOrgan->vascularRadioKidney ? 'ENABLED' : 'DISABLED' }}
                        </td>
                    </tr>
                    <tr>
                        <th>11. Vascular region Gut</th>
                        <td class="{{ $lkgOrgan->vascularRadioGut ? 'status-on' : 'status-off' }}">
                            {{ $lkgOrgan->vascularRadioGut ? 'ENABLED' : 'DISABLED' }}
                        </td>
                    </tr>
                    <tr>
                        <th>12. Vascular region Brain</th>
                        <td class="{{ $lkgOrgan->vascularRadioBrain ? 'status-on' : 'status-off' }}">
                            {{ $lkgOrgan->vascularRadioBrain ? 'ENABLED' : 'DISABLED' }}
                        </td>
                    </tr>
                    <tr>
                        <th>14. Gel volume tolerance percentage</th>
                        <td>{{ $lkgOrgan->vol_tolerance }} %</td>
                    </tr>
                    <tr>
                        <th>15. Cell density tolerance percentage</th>
                        <td>{{ $lkgOrgan->dens_tolerance }} %</td>
                    </tr>
                </table>

                <div class="section-header">Fibrinogen + Thrombin gel for Organs</div>
                <table>
                    <tr>
                        <th>18. Volume of Fibrinogen-Thrombin-cell gel (Liver)</th>
                        <td>{{ $lkgOrgan->fib_thromb_cell_liver }} ul</td>
                    </tr>
                    <tr>
                        <th>19. Tolerance volume (Liver)</th>
                        <td>{{ $lkgOrgan->tol_vol_liver }} ul</td>
                    </tr>
                    <tr>
                        <th>20. Volume of gel mix per plate (Liver)</th>
                        <td>{{ $lkgOrgan->vol_gel_mix_liver }} ul</td>
                    </tr>
                    <tr>
                        <th>21. Total gel for all plates (Liver)</th>
                        <td>{{ $lkgOrgan->tot_gel_plate_liver }} ul</td>
                    </tr>
                    <tr>
                        <th>24. Volume of Fibrinogen-Thrombin-cell gel (Kidney)</th>
                        <td>{{ $lkgOrgan->fib_thromb_cell_kid }} ul</td>
                    </tr>
                    <tr>
                        <th>25. Tolerance volume (Kidney)</th>
                        <td>{{ $lkgOrgan->tol_kid }} ul</td>
                    </tr>
                    <tr>
                        <th>26. Volume of gel mix per plate (Kidney)</th>
                        <td>{{ $lkgOrgan->gel_mix_plate_kid }} ul</td>
                    </tr>
                    <tr>
                        <th>27. Total gel for all plates (Kidney)</th>
                        <td>{{ $lkgOrgan->total_gel_kid }} ul</td>
                    </tr>
                    <tr>
                        <th>30. Volume of Fibrinogen-Thrombin-cell gel (Brain)</th>
                        <td>{{ $lkgOrgan->fib_throm_cell_brain }} ul</td>
                    </tr>
                    <tr>
                        <th>31. Tolerance volume (Brain)</th>
                        <td>{{ $lkgOrgan->tol_brain }} ul</td>
                    </tr>
                    <tr>
                        <th>32. Volume of gel mix per plate (Brain)</th>
                        <td>{{ $lkgOrgan->gel_mix_brain }} ul</td>
                    </tr>
                    <tr>
                        <th>33. Total gel for all plates (Brain)</th>
                        <td>{{ $lkgOrgan->total_gel_brain }} ul</td>
                    </tr>
                    <tr>
                        <th>36. Volume of Fibrinogen-Thrombin-cell gel (Gut)</th>
                        <td>{{ $lkgOrgan->fib_thromb_cell_gut }} ul</td>
                    </tr>
                    <tr>
                        <th>37. Tolerance volume (Gut)</th>
                        <td>{{ $lkgOrgan->tol_gut }} ul</td>
                    </tr>
                    <tr>
                        <th>38. Volume of gel mix per plate (Gut)</th>
                        <td>{{ $lkgOrgan->gel_mix_gut }} ul</td>
                    </tr>
                    <tr>
                        <th>39. Total gel for all plates (Gut)</th>
                        <td>{{ $lkgOrgan->total_gel_gut }} ul</td>
                    </tr>
                </table>

                <div class="section-header">VASCULAR REGION</div>
                <table>
                    <tr>
                        <th>42. Volume for Liver endothelial cells</th>
                        <td>{{ $lkgOrgan->vol_liver_endo }} ul</td>
                    </tr>
                    <tr>
                        <th>43. Volume for Kidney endothelial cells</th>
                        <td>{{ $lkgOrgan->vol_kid_endo }} ul</td>
                    </tr>
                    <tr>
                        <th>44. Volume for Brain endothelial cells</th>
                        <td>{{ $lkgOrgan->vol_brain_endo }} ul</td>
                    </tr>
                    <tr>
                        <th>45. Volume for Gut endothelial cells</th>
                        <td>{{ $lkgOrgan->vol_gut_endo }} ul</td>
                    </tr>
                    <tr>
                        <th>46. Total volume for endothelial cells</th>
                        <td>{{ $lkgOrgan->total_endo_vol }} ul</td>
                    </tr>
                    <tr>
                        <th>47. Total gel needed</th>
                        <td>{{ $lkgOrgan->total_gel_need }} ul</td>
                    </tr>
                </table>

                <div class="section-header">WORKING FIBRINOGEN SOLUTION</div>
                <table>
                    <tr>
                        <th>50. Phenol red color factor</th>
                        <td>{{ $lkgOrgan->phenol_fact }}</td>
                    </tr>
                    <tr>
                        <th>51. Required Total Fibrinogen gel working solution</th>
                        <td>{{ $lkgOrgan->total_fib_gel }} ul</td>
                    </tr>
                    <tr>
                        <th>52. Fibrinogen working solution concentration</th>
                        <td>{{ $lkgOrgan->fib_work_con }} mg/ml</td>
                    </tr>
                    <tr>
                        <th>53. Mass of phenol red to add to PBS</th>
                        <td>{{ $lkgOrgan->mass_phenol_pbs }} mg</td>
                    </tr>
                    <tr>
                        <th>54. Volume of PBS with phenol red</th>
                        <td>{{ $lkgOrgan->vol_pbs_phenol }} ul</td>
                    </tr>
                    <tr>
                        <th>55. Fibrinogen powder</th>
                        <td>{{ $lkgOrgan->fib_powder }} mg</td>
                    </tr>
                </table>

                <div class="section-header">STOCK SOLUTION OF THROMBIN</div>
                <table>
                    <tr>
                        <th>58. Number of NIH Units</th>
                        <td>{{ $lkgOrgan->no_nih_units }} U</td>
                    </tr>
                    <tr>
                        <th>59. U/mg Solid</th>
                        <td>{{ $lkgOrgan->umg_solid }} U/mg</td>
                    </tr>
                    <tr>
                        <th>60. Solid in bottle</th>
                        <td>{{ $lkgOrgan->solid_bottle }} mg</td>
                    </tr>
                    <tr>
                        <th>61. Units in bottle</th>
                        <td>{{ $lkgOrgan->unit_bottle }} U</td>
                    </tr>
                    <tr>
                        <th>62. Desired concentration of Thrombin Stock Solution</th>
                        <td>{{ $lkgOrgan->con_thromb_sol }} U/ml</td>
                    </tr>
                    <tr>
                        <th>63. Desired volume of stock solution</th>
                        <td>{{ $lkgOrgan->des_vol_stock }} ml</td>
                    </tr>
                    <tr>
                        <th>64. Thrombin stock solution concentration in mg/ml</th>
                        <td>{{ $lkgOrgan->throm_sol_con }} mg/ml</td>
                    </tr>
                </table>

                <div class="section-header">THROMBIN WORKING SOLUTION</div>
                <table>
                    <tr>
                        <th>72. Required total thrombin gel working solution</th>
                        <td>{{ $lkgOrgan->tot_gel_work }} ul</td>
                    </tr>
                    <tr>
                        <th>73. Required thrombin concentration</th>
                        <td>{{ $lkgOrgan->req_throm_con }} U/ml</td>
                    </tr>
                    <tr>
                        <th>74. Thrombin working solution</th>
                        <td>{{ $lkgOrgan->throm_work_sol }} ul</td>
                    </tr>
                    <tr>
                        <th>75. Volume of heparin medium for required concentration</th>
                        <td>{{ $lkgOrgan->vol_hep_con }} ul</td>
                    </tr>
                    <tr>
                        <th>76. Heparin-Thrombin solution</th>
                        <td>{{ $lkgOrgan->hep_thromb_sol }} ul</td>
                    </tr>
                </table>

                <div class="section-header">CELLS AVAILABLE FROM T FLASKS</div>
                <table>
                    <tr>
                        <th>79. Number of Liver cells from T-flask</th>
                        <td>{{ $lkgOrgan->no_liver_cells }} cells</td>
                    </tr>
                    <tr>
                        <th>80. Number of flasks</th>
                        <td>{{ $lkgOrgan->no_liv_flask }}</td>
                    </tr>
                    <tr>
                        <th>81. Total Number of Liver cells</th>
                        <td>{{ $lkgOrgan->tot_liver_cell }} cells</td>
                    </tr>
                    <tr>
                        <th>83. Number of Kidney cells from T-75 flask</th>
                        <td>{{ $lkgOrgan->no_kid_cells }} cells</td>
                    </tr>
                    <tr>
                        <th>84. Number of flasks</th>
                        <td>{{ $lkgOrgan->no_kid_flask }}</td>
                    </tr>
                    <tr>
                        <th>85. Total Number of Kidney cells</th>
                        <td>{{ $lkgOrgan->tot_kid_cell }} cells</td>
                    </tr>
                    <tr>
                        <th>87. Number of Gut cells from T-75 flask</th>
                        <td>{{ $lkgOrgan->no_gut_cells }} cells</td>
                    </tr>
                    <tr>
                        <th>88. Number of flasks</th>
                        <td>{{ $lkgOrgan->no_gut_flask }}</td>
                    </tr>
                    <tr>
                        <th>89. Total Number of Gut cells</th>
                        <td>{{ $lkgOrgan->tot_gut_cell }} cells</td>
                    </tr>
                    <tr>
                        <th>91. Number of Brain cells from T-75 flask</th>
                        <td>{{ $lkgOrgan->no_brain_cells }} cells</td>
                    </tr>
                    <tr>
                        <th>92. Number of flasks</th>
                        <td>{{ $lkgOrgan->no_brain_flask }}</td>
                    </tr>
                    <tr>
                        <th>93. Total Number of Brain cells</th>
                        <td>{{ $lkgOrgan->tot_brain_cell }} cells</td>
                    </tr>
                    <tr>
                        <th>95. Number of Endothelial cells from T75 flask</th>
                        <td>{{ $lkgOrgan->no_endo_cells }} cells</td>
                    </tr>
                    <tr>
                        <th>96. Number of flasks</th>
                        <td>{{ $lkgOrgan->no_endo_flask }}</td>
                    </tr>
                    <tr>
                        <th>97. Total number of Endothelial cells</th>
                        <td>{{ $lkgOrgan->tot_endo_cell }} cells</td>
                    </tr>
                    <tr>
                        <th>99. Number of Fibroblast cells from T75 flask</th>
                        <td>{{ $lkgOrgan->no_fib_cells }} cells</td>
                    </tr>
                    <tr>
                        <th>100. Number of flasks</th>
                        <td>{{ $lkgOrgan->no_fib_flask }}</td>
                    </tr>
                    <tr>
                        <th>101. Total number of Fibroblast cells</th>
                        <td>{{ $lkgOrgan->tot_fib_cell }} cells</td>
                    </tr>
                </table>

                <div class="section-header">LIVER</div>
                <table>
                    <tr>
                        <th>105. Desired cell density for organ in channel</th>
                        <td>{{ $lkgOrgan->des_dens_org_liv }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>106. Cells required for the experiment</th>
                        <td>{{ $lkgOrgan->cells_req_exp_liv }} cells</td>
                    </tr>
                    <tr>
                        <th>107. Resuspension cell density in tube</th>
                        <td>{{ $lkgOrgan->res_cell_dens_liv }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>108. Resuspension media volume in the tube</th>
                        <td>{{ $lkgOrgan->res_vol_liv }} ul</td>
                    </tr>
                    <tr>
                        <th>109. Volume of cells for thrombin working solution</th>
                        <td>{{ $lkgOrgan->vol_throm_mix_liv }} ul</td>
                    </tr>
                    <tr>
                        <th>110. Volume of cell resuspension left</th>
                        <td>{{ $lkgOrgan->vol_res_left_liv }} ul</td>
                    </tr>
                    <tr>
                        <th>111. Cells remaining</th>
                        <td>{{ $lkgOrgan->cell_remain_liv }} cells</td>
                    </tr>
                    <tr>
                        <th>112. Volume of thrombin working solution</th>
                        <td>{{ $lkgOrgan->working_solution_liv }} ul</td>
                    </tr>
                    <tr>
                        <th>113. Volume of fibrinogen solution</th>
                        <td>{{ $lkgOrgan->fibrinogen_solution_liv }} ul</td>
                    </tr>
                </table>

                <div class="section-header">KIDNEY</div>
                <table>
                    <tr>
                        <th>116. Desired cell density for organ in channel</th>
                        <td>{{ $lkgOrgan->des_dens_org_kid }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>117. Cells required for the experiment</th>
                        <td>{{ $lkgOrgan->cells_req_exp_kid }} cells</td>
                    </tr>
                    <tr>
                        <th>118. Resuspension cell density in tube</th>
                        <td>{{ $lkgOrgan->res_cell_dens_kid }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>119. Resuspension media volume in the tube</th>
                        <td>{{ $lkgOrgan->res_vol_kid }} ul</td>
                    </tr>
                    <tr>
                        <th>120. Volume of cells for thrombin working solution</th>
                        <td>{{ $lkgOrgan->vol_throm_mix_kid }} ul</td>
                    </tr>
                    <tr>
                        <th>121. Volume of cell resuspension left</th>
                        <td>{{ $lkgOrgan->vol_res_left_kid }} ul</td>
                    </tr>
                    <tr>
                        <th>122. Cells remaining</th>
                        <td>{{ $lkgOrgan->cell_remain_kid }} cells</td>
                    </tr>
                    <tr>
                        <th>123. Volume of thrombin working solution</th>
                        <td>{{ $lkgOrgan->working_solution_kid }} ul</td>
                    </tr>
                    <tr>
                        <th>124. Volume of fibrinogen solution</th>
                        <td>{{ $lkgOrgan->fibrinogen_solution_kid }} ul</td>
                    </tr>
                </table>

                <div class="section-header">GUT</div>
                <table>
                    <tr>
                        <th>127. Desired cell density for organ in channel</th>
                        <td>{{ $lkgOrgan->des_dens_org_gut }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>128. Cells required for the experiment</th>
                        <td>{{ $lkgOrgan->cells_req_exp_gut }} cells</td>
                    </tr>
                    <tr>
                        <th>129. Resuspension cell density in tube</th>
                        <td>{{ $lkgOrgan->res_cell_dens_gut }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>130. Resuspension media volume in the tube</th>
                        <td>{{ $lkgOrgan->res_vol_gut }} ul</td>
                    </tr>
                    <tr>
                        <th>131. Volume of cells for thrombin working solution</th>
                        <td>{{ $lkgOrgan->vol_throm_mix_gut }} ul</td>
                    </tr>
                    <tr>
                        <th>132. Volume of cell resuspension left</th>
                        <td>{{ $lkgOrgan->vol_res_left_gut }} ul</td>
                    </tr>
                    <tr>
                        <th>133. Cells remaining</th>
                        <td>{{ $lkgOrgan->cell_remain_gut }} cells</td>
                    </tr>
                    <tr>
                        <th>134. Volume of thrombin working solution</th>
                        <td>{{ $lkgOrgan->working_solution_gut }} ul</td>
                    </tr>
                    <tr>
                        <th>135. Volume of fibrinogen solution</th>
                        <td>{{ $lkgOrgan->fibrinogen_solution_gut }} ul</td>
                    </tr>
                </table>

                <div class="section-header">BRAIN</div>
                <table>
                    <tr>
                        <th>138. Desired cell density for organ in channel</th>
                        <td>{{ $lkgOrgan->des_dens_org_brain }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>139. Cells required for the experiment</th>
                        <td>{{ $lkgOrgan->cells_req_exp_brain }} cells</td>
                    </tr>
                    <tr>
                        <th>140. Resuspension cell density in tube</th>
                        <td>{{ $lkgOrgan->res_cell_dens_brain }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>141. Resuspension media volume in the tube</th>
                        <td>{{ $lkgOrgan->res_vol_brain }} ul</td>
                    </tr>
                    <tr>
                        <th>142. Volume of cells for thrombin working solution</th>
                        <td>{{ $lkgOrgan->vol_throm_mix_brain }} ul</td>
                    </tr>
                    <tr>
                        <th>143. Volume of cell resuspension left</th>
                        <td>{{ $lkgOrgan->vol_res_left_brain }} ul</td>
                    </tr>
                    <tr>
                        <th>144. Cells remaining</th>
                        <td>{{ $lkgOrgan->cell_remain_brain }} cells</td>
                    </tr>
                    <tr>
                        <th>145. Volume of thrombin working solution</th>
                        <td>{{ $lkgOrgan->working_solution_brain }} ul</td>
                    </tr>
                    <tr>
                        <th>146. Volume of fibrinogen solution</th>
                        <td>{{ $lkgOrgan->fibrinogen_solution_brain }} ul</td>
                    </tr>
                </table>

                <div class="section-header">ENDOTHELIAL CELLS / FIBROBLAST FOR OUTER CHANNELS</div>
                <table>
                    <tr>
                        <th>149. Desired cell density for organ in channel</th>
                        <td>{{ $lkgOrgan->des_dens_org_endo }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>150. Cells required for the experiment</th>
                        <td>{{ $lkgOrgan->cells_req_exp_endo }} cells</td>
                    </tr>
                    <tr>
                        <th>151. Resuspension cell density in tube</th>
                        <td>{{ $lkgOrgan->res_cell_dens_endo }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>152. Resuspension media volume in the tube</th>
                        <td>{{ $lkgOrgan->res_vol_endo }} ul</td>
                    </tr>
                    <tr>
                        <th>153. Volume of cells for thrombin working solution</th>
                        <td>{{ $lkgOrgan->vol_throm_mix_endo }} ul</td>
                    </tr>
                    <tr>
                        <th>154. Volume of cell resuspension left</th>
                        <td>{{ $lkgOrgan->vol_res_left_endo }} ul</td>
                    </tr>
                    <tr>
                        <th>155. Cells remaining</th>
                        <td>{{ $lkgOrgan->cell_remain_endo }} cells</td>
                    </tr>
                    <tr>
                        <th>156. Volume of thrombin working solution</th>
                        <td>{{ $lkgOrgan->working_solution_endo }} ul</td>
                    </tr>
                    <tr>
                        <th>157. Volume of fibrinogen solution</th>
                        <td>{{ $lkgOrgan->fibrinogen_solution_endo }} ul</td>
                    </tr>
                </table>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} Biopico Systems. All rights reserved.</p>
                <p>Human-Relevant Multiorgan Models & Calibration Reports</p>
            </div>
        </div>
    </div>
</body>

</html>