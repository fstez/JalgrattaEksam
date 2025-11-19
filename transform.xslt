<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<!-- Вывод HTML -->
	<xsl:output method="html" indent="yes" />

	<!-- Параметр фильтрации — из URL: exams.xml?examiner=Ivanov -->
	<xsl:param name="examiner" />

	<xsl:template match="/">
		<html>
			<head>
				<meta charset="UTF-8"/>
				<title>Exams</title>
				<style>
					table { border-collapse: collapse; width: 600px; }
					th, td { border: 1px solid black; padding: 5px; }
					th { background: #f0f0f0; }
				</style>
			</head>

			<body>
				<h2>Exam schedule</h2>

				<table>
					<tr>
						<th>Date and Time</th>
						<th>Room</th>
						<th>Examiner</th>
						<th>Duration</th>
					</tr>

					<!-- сортировка по datetime -->
					<xsl:for-each select="exams/exam">
						<xsl:sort select="datetime" data-type="text" order="ascending"/>

						<xsl:if test="$examiner = '' or contains(examiner, $examiner)">
							<tr>
								<td>
									<xsl:value-of select="datetime"/>
								</td>
								<td>
									<xsl:value-of select="location"/>
								</td>
								<td>
									<xsl:value-of select="examiner"/>
								</td>
								<td>
									<xsl:value-of select="duration"/> min
								</td>
							</tr>
						</xsl:if>
					</xsl:for-each>

				</table>
			</body>
		</html>
	</xsl:template>

</xsl:stylesheet>
