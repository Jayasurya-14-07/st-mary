<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete BBB Organ Submission Details</title>
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
            background: linear-gradient(135deg, #2e1065 0%, #1e1b4b 100%);
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
            color: #2e1065;
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
                <h1>Full Calibration Report: BBB ORGAN</h1>
                <p style="margin-top:5px; font-size:14px; opacity:0.8;">Submission ID: #{{ $bbbOrgan->id }} |
                    {{ $bbbOrgan->created_at->format('M d, Y') }}</p>
            </div>
            <div class="content">

                <div class="section-header">1. Submitter Information</div>
                <table>
                    <tr>
                        <th>Name</th>
                        <td>{{ $bbbOrgan->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $bbbOrgan->email }}</td>
                    </tr>
                </table>

                <div class="section-header">General</div>
                <table>
                    <tr>
                        <th>2. Number of units per plate</th>
                        <td>{{ $bbbOrgan->unit_plate }}</td>
                    </tr>
                    <tr>
                        <th>3. No of Plates</th>
                        <td>{{ $bbbOrgan->no_of_plates }}</td>
                    </tr>
                    <tr>
                        <th>4. Gel volume tolerance percentage</th>
                        <td>{{ $bbbOrgan->vol_tolerance }} %</td>
                    </tr>
                    <tr>
                        <th>5. Cell density tolerance percentage</th>
                        <td>{{ $bbbOrgan->dens_tolerance }} %</td>
                    </tr>
                    <tr>
                        <th>7. Endothelial Cells</th>
                        <td class="{{ $bbbOrgan->flexRadioEndothelialCells ? 'status-on' : 'status-off' }}">
                            {{ $bbbOrgan->flexRadioEndothelialCells ? 'ENABLED' : 'DISABLED' }}</td>
                    </tr>
                    <tr>
                        <th>8. Pericytes</th>
                        <td class="{{ $bbbOrgan->flexRadioPericytes ? 'status-on' : 'status-off' }}">
                            {{ $bbbOrgan->flexRadioPericytes ? 'ENABLED' : 'DISABLED' }}</td>
                    </tr>
                    <tr>
                        <th>9. Astrocytes</th>
                        <td class="{{ $bbbOrgan->flexRadioAstrocytes ? 'status-on' : 'status-off' }}">
                            {{ $bbbOrgan->flexRadioAstrocytes ? 'ENABLED' : 'DISABLED' }}</td>
                    </tr>
                </table>

                <div class="section-header">Fibrinogen + Thrombin Gel for BBB</div>
                <table>
                    <tr>
                        <th>12. Volume of Fibrinogen-Thrombin-cell gel</th>
                        <td>{{ $bbbOrgan->fib_throm_cell }} ul</td>
                    </tr>
                    <tr>
                        <th>13. Tolerance volume</th>
                        <td>{{ $bbbOrgan->tol_vol }} ul</td>
                    </tr>
                    <tr>
                        <th>14. Volume of gel mix per plate</th>
                        <td>{{ $bbbOrgan->vol_gel_mix }} ul</td>
                    </tr>
                    <tr>
                        <th>15. Total gel for all plates</th>
                        <td>{{ $bbbOrgan->total_gel_plate }} ul</td>
                    </tr>
                </table>

                <div class="section-header">Working Fibrinogen Solution</div>
                <table>
                    <tr>
                        <th>18. Phenol red color factor</th>
                        <td>{{ $bbbOrgan->phenol_red }}</td>
                    </tr>
                    <tr>
                        <th>19. Required Total Fibrinogen gel working solution</th>
                        <td>{{ $bbbOrgan->total_fib_gel }} ul</td>
                    </tr>
                    <tr>
                        <th>20. Fibrinogen working solution concentration</th>
                        <td>{{ $bbbOrgan->fibrin_con }} mg/ml</td>
                    </tr>
                    <tr>
                        <th>21. Mass of phenol red to add to PBS</th>
                        <td>{{ $bbbOrgan->phenol_red_pbs }} mg</td>
                    </tr>
                    <tr>
                        <th>22. Volume of PBS with phenol red</th>
                        <td>{{ $bbbOrgan->fibrin_pbs }} ml</td>
                    </tr>
                    <tr>
                        <th>23. Fibrinogen powder</th>
                        <td>{{ $bbbOrgan->fibrin_powder }} mg</td>
                    </tr>
                </table>

                <div class="section-header">Stock solution of Thrombin</div>
                <table>
                    <tr>
                        <th>26. Number of NIH Units</th>
                        <td>{{ $bbbOrgan->umg_protein }} U</td>
                    </tr>
                    <tr>
                        <th>27. U/mg Solid</th>
                        <td>{{ $bbbOrgan->umg_solid }} U/mg</td>
                    </tr>
                    <tr>
                        <th>28. Solid in bottle</th>
                        <td>{{ $bbbOrgan->solid_bottle }} mg</td>
                    </tr>
                    <tr>
                        <th>29. Units in bottle</th>
                        <td>{{ $bbbOrgan->unit_bottle }} U</td>
                    </tr>
                    <tr>
                        <th>30. Desired concentration of Thrombin Stock Solution</th>
                        <td>{{ $bbbOrgan->con_thrombin }} U/ml</td>
                    </tr>
                    <tr>
                        <th>31. Desired volume of stock solution</th>
                        <td>{{ $bbbOrgan->vol_stack_sol }} ml</td>
                    </tr>
                    <tr>
                        <th>32. Thrombin stock solution concentration in mg/ml</th>
                        <td>{{ $bbbOrgan->thromb_sol_con }} mg/ml</td>
                    </tr>
                </table>

                <div class="section-header">Thrombin 1X Working solution</div>
                <table>
                    <tr>
                        <th>35. Required Total thrombin gel working solution</th>
                        <td>{{ $bbbOrgan->thrombin_gel_making }} ul</td>
                    </tr>
                    <tr>
                        <th>36. Required thrombin concentration</th>
                        <td>{{ $bbbOrgan->thromb_con }} U/ml</td>
                    </tr>
                    <tr>
                        <th>37. Thrombin working solution</th>
                        <td>{{ $bbbOrgan->thromb_working_sol }} ul</td>
                    </tr>
                    <tr>
                        <th>38. Volume of heparin medium for required concentration</th>
                        <td>{{ $bbbOrgan->vol_heparin }} ul</td>
                    </tr>
                    <tr>
                        <th>39. Heparin-Thrombin Solution</th>
                        <td>{{ $bbbOrgan->heparin_thromb }} ul</td>
                    </tr>
                </table>

                <div class="section-header">Cells Available from T flasks</div>
                <table>
                    <tr>
                        <th>42. Number of Endothelial cells from T-flask</th>
                        <td>{{ $bbbOrgan->no_of_endo }} cells</td>
                    </tr>
                    <tr>
                        <th>43. Number of flasks</th>
                        <td>{{ $bbbOrgan->no_endo_flask }}</td>
                    </tr>
                    <tr>
                        <th>44. Total Number of endothelial cells</th>
                        <td>{{ $bbbOrgan->total_endo }} cells</td>
                    </tr>
                    <tr>
                        <th>46. Number of Pericytes from T-flask</th>
                        <td>{{ $bbbOrgan->no_of_peri }} cells</td>
                    </tr>
                    <tr>
                        <th>47. Number of flasks</th>
                        <td>{{ $bbbOrgan->no_peri_flask }}</td>
                    </tr>
                    <tr>
                        <th>48. Total number of pericytes</th>
                        <td>{{ $bbbOrgan->total_peri }} cells</td>
                    </tr>
                    <tr>
                        <th>50. Number of Astrocytes from T-flask</th>
                        <td>{{ $bbbOrgan->no_of_astro }} cells</td>
                    </tr>
                    <tr>
                        <th>51. Number of flasks</th>
                        <td>{{ $bbbOrgan->no_astro_flask }}</td>
                    </tr>
                    <tr>
                        <th>52. Total number of Astrocytes</th>
                        <td>{{ $bbbOrgan->total_astro }} cells</td>
                    </tr>
                </table>

                <div class="section-header">Cells for BBB</div>
                <table>
                    <tr>
                        <th>55. Desired cell density for Endothelial cells in channel</th>
                        <td>{{ $bbbOrgan->des_dens_endo }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>56. Desired cell density for Pericytes in channel</th>
                        <td>{{ $bbbOrgan->des_dens_peri }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>57. Desired cell density for Astrocytes in channel</th>
                        <td>{{ $bbbOrgan->des_dens_astro }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>58. Number of Endothelial cells required for the experiment</th>
                        <td>{{ $bbbOrgan->no_endo_exp }} cells</td>
                    </tr>
                    <tr>
                        <th>59. Number of Pericytes required for the experiment</th>
                        <td>{{ $bbbOrgan->no_peri_exp }} cells</td>
                    </tr>
                    <tr>
                        <th>60. Number of Astrocytes required for the experiment</th>
                        <td>{{ $bbbOrgan->no_astro_exp }} cells</td>
                    </tr>
                    <tr>
                        <th>61. Resuspension Endothelial cell density in vial</th>
                        <td>{{ $bbbOrgan->res_endo_dens }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>62. Resuspension Pericytes density in vial</th>
                        <td>{{ $bbbOrgan->res_peri_dens }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>63. Resuspension Astrocytes density in vial</th>
                        <td>{{ $bbbOrgan->res_astro_dens }} cells/ul</td>
                    </tr>
                    <tr>
                        <th>64. Total Volume of cells for thrombin mix</th>
                        <td>{{ $bbbOrgan->vol_throm_mix }} ul</td>
                    </tr>
                    <tr>
                        <th>65. Resuspension volume in the Endothelial cells tube</th>
                        <td>{{ $bbbOrgan->res_vol_endo }} ul</td>
                    </tr>
                    <tr>
                        <th>66. Resuspension volume in the Pericytes tube</th>
                        <td>{{ $bbbOrgan->res_vol_peri }} ul</td>
                    </tr>
                    <tr>
                        <th>67. Resuspension volume in the Astrocytes tube</th>
                        <td>{{ $bbbOrgan->res_vol_astro }} ul</td>
                    </tr>
                    <tr>
                        <th>68. Volume of Endothelial Resuspension for thrombin mix</th>
                        <td>{{ $bbbOrgan->vol_endo_thrombin_mix }} ul</td>
                    </tr>
                    <tr>
                        <th>69. Volume of Pericyte Resuspension for thrombin mix</th>
                        <td>{{ $bbbOrgan->vol_peri_thrombin_mix }} ul</td>
                    </tr>
                    <tr>
                        <th>70. Volume of Astrocyte Resuspension for thrombin mix</th>
                        <td>{{ $bbbOrgan->vol_astro_thrombin_mix }} ul</td>
                    </tr>
                    <tr>
                        <th>71. Volume of Endothelial cell resuspension left</th>
                        <td>{{ $bbbOrgan->vol_endo_res }} ul</td>
                    </tr>
                    <tr>
                        <th>72. Volume of Pericytes resuspension left</th>
                        <td>{{ $bbbOrgan->vol_peri_res }} ul</td>
                    </tr>
                    <tr>
                        <th>73. Volume of Astrocytes resuspension left</th>
                        <td>{{ $bbbOrgan->vol_astro_res }} ul</td>
                    </tr>
                    <tr>
                        <th>74. Number of Endothelial Cells remaining</th>
                        <td>{{ $bbbOrgan->no_endo_remain }} cells</td>
                    </tr>
                    <tr>
                        <th>75. Number of Pericytes remaining</th>
                        <td>{{ $bbbOrgan->no_peri_remain }} cells</td>
                    </tr>
                    <tr>
                        <th>76. Number of Astrocytes remaining</th>
                        <td>{{ $bbbOrgan->no_astro_remain }} cells</td>
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