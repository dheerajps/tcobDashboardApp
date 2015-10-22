USE [mubusassessment]
GO

/****** Object:  StoredProcedure [dbo].[getDashboardData]    Script Date: 10/20/2015 12:35:03 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		cwm
-- Create date: 10-14-2015
-- Description:	get ALL the data with group_id as a parameter
-- =============================================
CREATE PROCEDURE [dbo].[getDashboardData] 
	@groupid VARCHAR(MAX)
AS
BEGIN
	declare @sql nvarchar(MAX)
	SET @sql = 'SELECT DISTINCT dashboard_topics.topic_name, dashboard_sections.section_name,dashboard_urls.url_name, dashboard_urls.url_address FROM dbo.dashboard_urls INNER JOIN dbo.dashboard_linkURLtoGroup ON dbo.dashboard_urls.url_id = dbo.dashboard_linkURLtoGroup.url_id JOIN dbo.dashboard_groups ON dbo.dashboard_linkURLtoGroup.group_id = dbo.dashboard_groups.group_id JOIN dbo.dashboard_sections ON dbo.dashboard_urls.section_id = dbo.dashboard_sections.section_id JOIN dbo.dashboard_topics ON dbo.dashboard_urls.topic_id = dbo.dashboard_topics.topic_id WHERE dbo.dashboard_groups.group_id IN (' + @groupid + ')'
	EXECUTE sp_executesql @sql
END

GO
